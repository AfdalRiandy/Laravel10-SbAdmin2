<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Banner;

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
        Model::preventLazyLoading(!app()->isProduction());

        // Cache categories and banners for views
        View::composer('*', function ($view) {
            $categories = Cache::remember('categories_global', 3600, function () {
                return Category::all();
            });
            
            // Only load banners if needed (e.g. home page) or share globally if used in layout
            // For now, let's share categories globally as they are in the footer/menu
            $view->with('categories', $categories);
        });
    }
}
