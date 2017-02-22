<?php

namespace Metrique\Constituent;

interface ConstituentInterface
{
    /**
     * Intialises Constituent Blade Directive.
     */
    public static function bladeDirective();

    /**
     * Prepares a blade expression ready for use with laravel-building.
     *
     * @param  string $component
     * @param  array $params
     * @return array
     */
    public static function prepare(string $constituent, array $params = []);

    /**
     * Merges two arrays into a css class string
     * @param  array  $array1
     * @param  array $array2
     * @param  bool $implode
     * @return string
     */
    public function class(array $array1, array $array2 = [], $implode = true);
}
