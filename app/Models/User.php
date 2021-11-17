<?php

namespace App\Models;

use App\Traits\Planable;
use App\Mail\User\WelcomeEmail;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Concerns\IsFilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed plan
 * @property string api_token
 * @property mixed is_admin
 * @property bool plan_notified
 */
class User extends Authenticatable implements FilamentUser
{
    use Notifiable,
        Planable,
        HasFactory,
        IsFilamentUser;

    protected $fillable = [
        'name',
        'email',
        'password',
        'receive_email',
        'newsletter',
        'locale',
        'settings'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_admin' => 'boolean',
        'newsletter' => 'boolean',
        'receive_email' => 'boolean',
        'plan_notified' => 'boolean',
        'projects.pivot.owner' => 'boolean',
        'abilities' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'plan_expires_at'
    ];

    protected $appends = [
        'first_name',
        'settings'
    ];

    public static $filamentUserColumn = 'is_admin';

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getGravatar($size = 150)
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->attributes['email']))) . '?s=' . (int)$size;
    }

    public function getSettingsAttribute($value)
    {
        if (!$value) {
            return [
                'code_preview' => [
                    'rainbow' => false,
                ]
            ];
        }

        if (is_array($value)) {
            return $value;
        }

        return json_decode($value, true);
    }

    public function getFirstNameAttribute()
    {
        return array_first(explode(' ', $this->name), null, $this->name);
    }

    public function markAsExpired()
    {
        $this->plan_notified = true;
        $this->plan_expires_at = null;
        $this->plan_id = 1;

        $this->save();
    }

    public function generateNewToken()
    {
        $this->api_token = str_random(25);
        $this->save();
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function scopeWantsEmail($query)
    {
        return $query->where('receive_email', true);
    }

    public function scopeExpired($query)
    {
        return $query->where(function ($query) {
            return $query
                ->whereNotNull('plan_expires_at')
                ->where('plan_expires_at', '<', now())
                ->where('plan_notified', false);
        });
    }

    public function scopePaidPlan($query)
    {
        return $query->whereNotNull('plan_expires_at');
    }

    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class)->latest();
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ordersLatest()
    {
        return $this->hasMany(Order::class)->latest();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('owner');
    }

    public function projectGroups()
    {
        return $this->hasMany(ProjectGroup::class);
    }

    public function social_users()
    {
        return $this->hasMany(SocialUser::class);
    }

    public function socialUsersLatest()
    {
        return $this->hasMany(SocialUser::class)->latest();
    }

    public function fcmTokens()
    {
        return $this->hasMany(UserFcmToken::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_token = str_random(50);
        });

        static::created(function ($user) {
            \Mail::to($user)->send(new WelcomeEmail($user));
        });

        static::deleting(function (self $user) {
            foreach ($user->projects as $project) {
                $project->exceptions()->delete();

                $project->users()->detach($user->id);

                $project->delete();
            }

            $user->social_users()->delete();
            $user->newsletters()->detach();
        });
    }

    public function hasAbility($key)
    {
        return isset($this->abilities[$key]) && $this->abilities[$key];
    }
}
