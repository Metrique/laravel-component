<?php

namespace Metrique\Constituent;

use Illuminate\Support\Facades\Blade;
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
        $this->bootConstituentBladeDirective();
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

    protected function bootConstituentBladeDirective()
    {
        Blade::directive('constituent', function ($expression) {
            return "<?php
                \$__expression = \IHG\Support\Component::component($expression);

                echo \$__env->make(\$__expression['component'], \$__expression['params'],
                array_except(get_defined_vars(), array('__data', '__path')))->render();

                unset(\$__expression);
            ?>";
        });
    }
}
