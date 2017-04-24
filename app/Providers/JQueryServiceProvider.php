<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JQueryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            base_path() . '/vendor/components/jquery/jquery.min.js' => public_path('vendor/jquery/jquery.min.js'),
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