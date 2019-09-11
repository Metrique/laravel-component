<?php

namespace Metrique\Constituent\Traits;

use Illuminate\Support\Str;

trait Strings
{
    public function toTitleCase(string $string)
    {
        $string = Str::snake($string);
        $string = str_replace('_', ' ', $string);
        $string = ucfirst($string);
        $string = preg_replace('/(\S)([\d-]+)/', '$1 $2', $string);

        return $string;
    }
}
