<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class EthServiceProvider extends ServiceProvider
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
        App::bind('eth', function(){
            return new \App\Eth;
        });
    }
}
