<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{


    public function index()
    {
        return view("upload-file");
    }

    public function store(Request $request)
    {
        if (request()->has('mycsv')) {
            // $data =  array_map('str_getcsv', file(request()->mycsv));
            $data =   file(request()->mycsv);
            // $header = $data[0];
            // unset($data[0]);

            // chunking file 
            $chunks  =  array_chunk($data, 1000); //1000 record 
            $path = public_path('temp');
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";
                // return $path . $name;
                file_put_contents($path . $name, $chunk);
            }

            $files  = glob("$path/*.csv");
            $header = [];
            foreach ($files as  $key =>  $file) {

                $data = array_map('str_getcsv', file($file));
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                SalesCsvProcess::dispatch($data, $header);
                unlink($file);
            }
            return 'stored';
        }
    }
}
