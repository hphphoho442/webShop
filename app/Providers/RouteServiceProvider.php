<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')
        ->group(base_path('routes/web.php'));

        // Route cho admin
        Route::middleware(['web', 'auth', 'role:admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));

        // Route cho client
        Route::middleware(['web', 'auth'])
            ->group(base_path('routes/shop.php'));

        // API routes (nếu có)
        // Route::middleware('api')
        //     ->prefix('api')
        //     ->group(base_path('routes/api.php'));
    }
}
