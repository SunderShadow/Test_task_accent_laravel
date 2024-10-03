<?php

namespace App\Providers;

use App\View\Composers\HeaderViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('menu', [
            'home'  => 'Home',
            'about' => 'About',
            'news'  => 'News',
        ]);

    }
}
