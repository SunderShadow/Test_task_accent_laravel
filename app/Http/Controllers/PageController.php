<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CitySlug;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(CitySlug::class);
    }

    public function home(Request $request, $selectedCitySlug)
    {
        $cities = $request->get('cities');
        return view('welcome', compact(['cities', 'selectedCitySlug']));
    }

    public function about()
    {
        return view('about');
    }

    public function news()
    {
        return view('news');
    }
}
