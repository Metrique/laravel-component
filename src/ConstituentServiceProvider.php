<?php

namespace Metrique\Constituent;

use Illuminate\Support\ServiceProvider;
use Metrique\Constituent\ConstituentViewComposer;

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
        $this->bootViewComposer();
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

    protected function bootBladeDirective()
    {
        Constituent::bladeDirective();
    }

    protected function bootViewComposer()
    {
        view()->composer('*', ConstituentViewComposer::class);
    }
}
