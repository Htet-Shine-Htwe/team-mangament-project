<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_ENV')== "local")
        {
            $this->app->singleton('storageProvider', function () {
                return 's3';
            });
        }
        else
        {
            $this->app->singleton('storageProvider', function () {
                return 'local';
            });
        }
    }
}
