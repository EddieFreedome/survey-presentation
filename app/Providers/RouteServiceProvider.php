<?php

namespace App\Providers;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }
    // protected $namespace = 'App\Http\Controllers';
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Route::prefix('api')
        // ->middleware('api')
        // ->namespace('App\Http\Controllers') // <---------
        // ->group(base_path('routes/api.php'));

        // Non-static method Illuminate\Routing\Route::middleware() cannot be called statically (error)
        // Route::middleware('web')
        //      ->namespace($this->namespace)
        //      ->group(base_path('routes/web.php'));
    }

    
}
