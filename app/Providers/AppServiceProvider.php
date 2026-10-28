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
        $this->ensureStorageDirectoriesExist();
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

    private function ensureStorageDirectoriesExist(): void
    {
        foreach ([
            storage_path('app/public'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ] as $directory) {
            if (is_dir($directory)) {
                continue;
            }

            @mkdir($directory, 0755, true);
        }
    }
}
