<?php

namespace Dipesh79\LaravelPayeerCheckout;

use Illuminate\Support\ServiceProvider;

class PayeerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/payeer.php' => config_path('payeer.php'),
        ], 'config');
    }
}
