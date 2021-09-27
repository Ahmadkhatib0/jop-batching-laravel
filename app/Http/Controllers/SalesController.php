<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{


    public function store(Request $request)
    {
        if (request()->has('mycsv')) {
            // $data =  array_map('str_getcsv', file(request()->mycsv));
            $data =   file(request()->mycsv);
            // $header = $data[0];
            // unset($data[0]);

            // chunking file 
            $chunks  =  array_chunk($data, 1000); //1000 record 
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";
                $path = public_path('temp');
                // return $path . $name;
                file_put_contents($path . $name, $chunk);
            }

            // foreach ($data as $item) {
            //     $salesData = array_combine($header, $item);
            //     Sales::create($salesData);
            // }
            return 'done';
        }
    }


    public function create()
    {
        $path = public_path('temp');
        $files  = glob("$path/*.csv");

        $header = [];
        foreach ($files as  $key =>  $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }
            foreach ($data as $sale) {
                $salesData = array_combine($header, $sale);
                Sales::create($salesData);
            }
        }
        return 'stored';
    }
}
