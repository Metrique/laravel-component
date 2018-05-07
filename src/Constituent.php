<?php

namespace Metrique\Constituent;

use Illuminate\Support\Facades\Blade;

use Metrique\Constituent\Traits\ArrayParameters;
use Metrique\Constituent\Traits\StringParameters;
use Metrique\Constituent\Traits\Strings;

class Constituent implements ConstituentInterface
{
    use ArrayParameters;
    use StringParameters;
    use Strings;
    
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
        array_key_exists('attributes', $params) ?: $params['attributes'] = [];
        array_key_exists('class', $params) ?: $params['class'] = [];

        return [
            'constituent' => config('view.constituent.prefix', '') . $constituent,
            'params' => $params,
        ];
    }

    public function class(array $array1, array $array2 = [], $implode = true)
    {
        $classes = collect(array_merge($array1, $array2))
            ->filter(function ($value, $key) {
                if (is_int($key)) {
                    return true;
                }
                
                return $value;
            })->map(function ($value, $key) {
                if (is_int($key)) {
                    return $value;
                }
                return $key;
            });
            
        if ($implode) {
            return rtrim($classes->reduce(function ($carry, $item) {
                return $carry . $item . ' ';
            }));
        }

        return $classes->toArray();
    }

    public function classAttr(array $array1, array $array2 = [])
    {
        $classes = $this->class($array1, $array2);

        if (empty($classes)) {
            return '';
        }

        return sprintf('class="%s"', trim($classes));
    }

    public function attrIf(string $attrKey, string $attrValue)
    {
        if (!empty($attrValue)) {
            return sprintf('%s="%s"', $attrKey, $attrValue);
        }

        return '';
    }
}
