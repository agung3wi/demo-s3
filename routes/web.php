<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-exists', function () {
    return [
        "exists" => Storage::disk("s3")->exists("/hello.png")
    ];
});

Route::get('/test', function () {
    $headers = [
        "Content-Type" => Storage::disk("s3")->mimeType("/abc.png")
    ];
    return response(Storage::disk("s3")->get("/abc.png"), 200, $headers);
});
