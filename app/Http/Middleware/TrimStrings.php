<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
        'exception.executor.*.line'
    ];

    protected function cleanArray(array $data, $keyPrefix = '')
    {
        return collect($data)->map(function ($value, $key) use ($keyPrefix) {
            // convert key into wildcard if its an integer
            $key = is_numeric($key) ? "*" : $key;
            return $this->cleanValue($keyPrefix.$key, $value);
        })->all();
    }
}
