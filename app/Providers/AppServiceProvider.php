<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;

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
        // Share the $paginator variable with the custom pagination view for gallery only
        View::composer('vendor.pagination.gallery', function ($view) {
            // Check if the paginator is an instance of LengthAwarePaginator
            if (isset($view->getData()['paginator']) && $view->getData()['paginator'] instanceof LengthAwarePaginator) {
                $paginator = $view->getData()['paginator'];
                $view->with('paginator', $paginator);
            }
        });
    }
}