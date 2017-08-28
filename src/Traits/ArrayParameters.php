<?php

namespace Metrique\Constituent\Traits;

trait ArrayParameters
{
    /**
     * Converts an array in to HTML attributes
     *
     * @param  array $parameters
     * @return string
     */
    public function parseArrayParameters(array $parameters)
    {
        $attributes = collect($parameters)->map(function ($item, $key) {
            if (is_int($key)) {
                return $item;
            }
            
            return sprintf('%s="%s"', $key, $item);
        })->reduce(function ($carry, $item) {
            return $carry . ' ' . $item;
        }, '');
        
        return trim($attributes);
    }
}
