<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return "about page";
});

Route::get('/upload', function () {
    return view("upload-file");
});
Route::post('/upload', function () {
});
