<?php

namespace Metrique\Constituent\Traits;

trait StringParameters
{
    /**
     * Breaks apart a string into key/value pairs,
     * typically this would be a querystring.
     *
     * , denotes a new item.
     * : denotes a key/value seperator.
     * | denotes multiple items in value.
     *
     * eg: ?location=longitude:1.0,latitude:1.0
     *
     * @param  string $parameters
     * @return array
     */
    public function parseStringParameters(string $parameters)
    {
        $increment = 0;
        $parameters = explode(',', $parameters, 255);

        return collect($parameters)->mapWithKeys(
            function ($parameter) use (&$increment) {

                // Look for key:value
                $keyValues = explode(':', $parameter, 2);

                if (count($keyValues) == 2) {
                    $key = trim($keyValues[0]);
                    $value = $keyValues[1];
                }

                // If no key value separator is given then just index into the array.
                if (count($keyValues) == 1) {
                    $key = $increment++;
                    $value = $parameter;
                }

                // Look for multiple items in value.
                $values = explode('|', $value);

                if (count($value) > 1) {
                    $value = $values;
                }

                return [
                    $key => $value
                ];
            }
        );
    }
}
