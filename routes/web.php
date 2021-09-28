<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/upload-file', [SalesController::class, 'index']);
Route::post('/upload', [SalesController::class, 'store']);
Route::get('/batch', [SalesController::class, 'batch']);
