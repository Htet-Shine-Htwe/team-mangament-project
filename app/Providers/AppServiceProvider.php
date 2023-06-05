<?php

namespace App\Providers;

use App\Models\UserWorkspace;
use Illuminate\Support\Facades\Blade;
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
        if(env('APP_ENV') == "dev")
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

        Blade::if('hasWorkspace', function () {
            $workspaces = UserWorkspace::getUserWorkspaces()->get();

            return count($workspaces) <= 0 ? false : true;
        });
    }
}
