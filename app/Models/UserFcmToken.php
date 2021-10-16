<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\UserFcmToken
 *
 * @property int $id
 * @property mixed|null $token
 * @property array|null $device
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFcmToken whereUserId($value)
 * @mixin \Eloquent
 */
class UserFcmToken extends Model
{
    use HasFactory;

    public $casts = [
        'token' => 'encrypted',
        'device' => 'array',
    ];

    public $fillable = [
        'token',
        'device',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
