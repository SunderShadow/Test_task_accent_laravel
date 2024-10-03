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
    Route::get('/', function ($selectedCitySlug) {
        $cities = \App\Models\City::query()->orderBy('name', 'ASC')->get();

        $cities = $cities->collect();
        $city = $cities->firstWhere(function ($a) use ($selectedCitySlug) {
            return $a['slug'] === $selectedCitySlug;
        });

        if (!$city) {
            return redirect('/');
        }
        session()->put('selectedCitySlug', $city['slug']); // Да, я захардкодил, ибо нефиг

        return view('welcome', compact(['cities', 'selectedCitySlug']));
    });
});
