<?php

namespace App\Models;

use App\Traits\Planable;
use App\Mail\User\WelcomeEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $billing_details
 * @property array|null $settings
 * @property string $password
 * @property string|null $api_token
 * @property int $first_setup
 * @property bool $is_admin
 * @property string $locale
 * @property bool $newsletter
 * @property bool $receive_email
 * @property int|null $plan_id
 * @property \Illuminate\Support\Carbon|null $plan_expires_at
 * @property bool $plan_notified
 * @property string|null $remember_token
 * @property string|null $google2fa_secret
 * @property int $total_logins
 * @property string|null $last_mobile_login_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserFcmToken[] $fcmTokens
 * @property-read int|null $fcm_tokens_count
 * @property-read mixed $first_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Newsletter[] $newsletters
 * @property-read int|null $newsletters_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $ordersLatest
 * @property-read int|null $orders_latest_count
 * @property-read \App\Models\Plan|null $plan
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectGroup[] $projectGroups
 * @property-read int|null $project_groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SocialUser[] $socialUsersLatest
 * @property-read int|null $social_users_latest_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SocialUser[] $social_users
 * @property-read int|null $social_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|User expired()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User paidPlan()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User wantsEmail()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBillingDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstSetup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogle2faSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastMobileLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlanExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlanNotified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReceiveEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTotalLogins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable,
        Planable,
        HasFactory;

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
        'projects.pivot.owner' => 'boolean'
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
                ->where('plan_expires_at', '<', carbon())
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
}
