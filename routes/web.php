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
Route::get('/', function () {
    $city = session()->get('selectedCitySlug', 'moskva');
    return redirect('/' . $city);
});

Route::prefix('/{selectedCitySlug}')->group(function () {
    Route::get('/',      [\App\Http\Controllers\PageController::class, 'home'])->name('home');
    Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
    Route::get('/news',  [\App\Http\Controllers\PageController::class, 'news'])->name('news');
});
