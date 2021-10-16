<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Statistic
 *
 * @property int $id
 * @property int $total_exceptions
 * @property int $total_fixed_exceptions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTotalExceptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTotalFixedExceptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
