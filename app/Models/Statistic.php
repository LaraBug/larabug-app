<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'total_exceptions'
    ];

    public static function getStatistics($key = 'total_exceptions')
    {
        return self::first([$key])->{$key};
    }

    public static function incrementStatistics($key = 'total_exceptions')
    {
        $stats = self::first();

        $stats->{$key} ++;
        $stats->save();
    }
}
