<?php

namespace App\View\Composers;

use Illuminate\View\View;

class HeaderViewComposer
{
    public function compose(View $view): void
    {
        $view->with('menu', [
            'home'  => 'Home',
            'about' => 'About',
            'news'  => 'News',
        ]);
    }
}
