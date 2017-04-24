<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * Move twitter bootstrap CSS and JS into public directory
     *
     * @return void
     */
    public function boot()
    {
        $dist = base_path() . '/vendor/twbs/bootstrap/dist/';

        $this->publishes([
            $dist . '/css/bootstrap.min.css' => public_path('vendor/bootstrap/css/bootstrap.min.css'),
            $dist . '/js/bootstrap.min.js' => public_path('vendor/bootstrap/js/bootstrap.min.js'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}