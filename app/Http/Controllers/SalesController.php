<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class SalesController extends Controller
{


    public function index()
    {
        return view("upload-file");
    }

    public function store(Request $request)
    {
        if (request()->has('mycsv')) {
            $data =   file(request()->mycsv);
            // chunking file 
            $chunks  =  array_chunk($data, 1000); //1000 record 
            $header = [];
            $batch = Bus::batch([])->dispatch();
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                $batch->add(new SalesCsvProcess($data, $header));
            }
            return $batch;
        }
    }


    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }
}
