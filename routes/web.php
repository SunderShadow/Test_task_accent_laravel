<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{city}', function () {
    $cities = json_decode(file_get_contents('https://api.hh.ru/areas'), true)[0];

    return view('welcome', compact(['cities']));
});
