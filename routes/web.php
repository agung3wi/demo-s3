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
    $fileName = "Screenshot 2021-11-04 at 18.01.43.png";
    $headers = [
        "Content-Type" => Storage::disk("s3")->mimeType($fileName)
    ];
    return response(Storage::disk("s3")->get($fileName), 200, $headers);
});

Route::get('google', function () {
    $dir = '/';
    $recursive = false; // Get subdirectories also?
    $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

    //return $contents->where('type', '=', 'dir'); // directories
    return $contents->where('type', '=', 'file'); // files
});
