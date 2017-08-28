<?php

namespace Metrique\Constituent\Traits;

trait Strings
{
    public function toTitleCase(string $string)
    {
        $string = snake_case($string);
        $string = str_replace('_', ' ', $string);
        $string = ucfirst($string);
        $string = preg_replace('/(\S)([\d-]+)/', '$1 $2', $string);
        
        return $string;
    }
}
