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
     *
     * @param  array  $array1
     * @param  array $array2
     * @param  bool $implode
     * @return string
     */
    public function class(array $array1, array $array2 = [], $implode = true);

    /**
     * Merges two arrays into an HTML class attribute.
     *
     * @param  array  $array1
     * @param  array $array2
     * @param  bool $implode
     * @return string
     */
    public function classAttr(array $array1, array $array2 = []);

    /**
     * Returns an attribute if the value is not empty.
     *
     * @param  string $attributeName  [description]
     * @param  string $attributeValue [description]
     * @return [type]                 [description]
     */
    public function attrIf(string $attrKey, string $attrValue);
}
