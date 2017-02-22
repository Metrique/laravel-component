<?php

namespace Metrique\Constituent;

use Illuminate\Support\ServiceProvider;

class ConstituentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeDirective();
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

    public function bootBladeDirective()
    {
        Constituent::bladeDirective();
    }
}
