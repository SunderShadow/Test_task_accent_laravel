<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitySlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route()->parameter('selectedCitySlug');
        $cities = \App\Models\City::query()->orderBy('name', 'ASC')->get();

        $city = $cities->collect()->firstWhere(function ($a) use ($slug) {
            return $a['slug'] === $slug;
        });

        if (!$city) {
            session()->put('selectedCitySlug', 'moskva'); // Да, я захардкодил, ибо нефиг
            session()->put('selectedCityName', 'Москва'); // Да, я захардкодил, ибо нефиг
            return redirect('/moskva');
        }

        $request->request->add(compact('cities'));

        session()->put('selectedCitySlug', $city['slug']);
        session()->put('selectedCityName', $city['name']);
        return $next($request);
    }
}
