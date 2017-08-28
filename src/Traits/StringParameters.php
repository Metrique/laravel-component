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
            function ($parameter, $key) use (&$increment) {
                $keyValues = explode(':', $parameter, 2);

                if (count($keyValues) != 2) {
                    return [$increment++ => $parameter];
                }

                return [
                    trim($keyValues[0]) => $keyValues[1]
                ];
            }
        );
    }
}
