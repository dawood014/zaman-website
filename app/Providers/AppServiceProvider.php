<?php

namespace App\Providers;

use App\Models\ContentItem;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'layouts.public'], function ($view) {
            $view->with('settings', Setting::pluck('value', 'key'));
            $view->with(
                'social',
                ContentItem::type('social')->published()->orderBy('sort_order')->get()
            );
        });
    }
}
