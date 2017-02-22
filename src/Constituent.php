<?php

namespace Metrique\Constituent;

use Illuminate\Support\Facades\Blade;

class Constituent implements ConstituentInterface
{
    public static function bladeDirective()
    {
        return Blade::directive('constituent', function ($expression) {
            return "<?php
                \$__expression = \Metrique\Constituent\Constituent::prepare($expression);

                echo \$__env->make(\$__expression['constituent'], \$__expression['params'],
                array_except(get_defined_vars(), array('__data', '__path')))->render();

                unset(\$__expression);
            ?>";
        });
    }

    public static function prepare(string $constituent, array $params = [])
    {
        array_key_exists('class', $params) ?: $params['class'] = [];
        $params['classes'] = $this->class($params['class']);

        return [
            'constituent' => $constituent,
            'params' => $params,
        ];
    }

    public function class(array $array1, array $array2 = [], $implode = true)
    {
        $classes = array_merge($array1, $array2);

        if ($implode) {
            return implode(' ', $classes);
        }

        return $classes;
    }
}
