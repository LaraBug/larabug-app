<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialUser
 *
 * @property int $id
 * @property string $provider
 * @property string $provider_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereUserId($value)
 * @mixin \Eloquent
 */
class SocialUser extends Model
{
    protected $fillable = [
        'provider',
        'provider_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
