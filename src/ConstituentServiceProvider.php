<?php

namespace Metrique\Constituent;

use Illuminate\Support\ServiceProvider;
use Metrique\Constituent\Constituent;
use Metrique\Constituent\ConstituentInterface;
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
        $this->app->singleton(ConstituentInterface::class, Constituent::class);
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
