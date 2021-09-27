<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function index()
    {
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if (request()->has('mycsv')) {
            $data =  array_map('str_getcsv', file(request()->mycsv));
            $header = $data[0];
            unset($data[0]);
            foreach ($data as $item) {
                $salesData = array_combine($header, $item);
                Sales::create($salesData);
            }
            return 'done';
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
