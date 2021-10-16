<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ProjectWasCreated;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Project
 *
 * @property string $id
 * @property string|null $title
 * @property string|null $url
 * @property string|null $key
 * @property string|null $description
 * @property string|null $slack_webhook
 * @property string|null $discord_webhook
 * @property string|null $custom_webhook
 * @property string $total_exceptions
 * @property bool $receive_email
 * @property bool $notifications_enabled
 * @property bool $mobile_notifications_enabled
 * @property bool $slack_webhook_enabled
 * @property bool $discord_webhook_enabled
 * @property bool $custom_webhook_enabled
 * @property string|null $group_id
 * @property int|null $user_id
 * @property string|null $last_error_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Exception[] $exceptions
 * @property-read int|null $exceptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feedback[] $feedback
 * @property-read int|null $feedback_count
 * @property-read mixed $feedback_script_html
 * @property-read mixed $route_url
 * @property-read mixed $screenshot
 * @property-read \App\Models\ProjectGroup|null $group
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wantsEmail()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCustomWebhook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCustomWebhookEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDiscordWebhook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDiscordWebhookEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLastErrorAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMobileNotificationsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereNotificationsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereReceiveEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSlackWebhook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSlackWebhookEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTotalExceptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUserId($value)
 * @mixin \Eloquent
 */
class Project extends Model implements HasMedia
{
    use Uuid,
        Filterable,
        Notifiable,
        InteractsWithMedia,
        HasFactory;

    protected $fillable = [
        'url',
        'title',
        'description',
        'receive_email',
        'notifications_enabled',
        'slack_webhook',
        'discord_webhook',
        'custom_webhook',
        'mobile_notifications_enabled',
        'slack_webhook_enabled',
        'discord_webhook_enabled',
        'custom_webhook_enabled',
    ];

    protected $dates = [
        'last_exception_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'receive_email' => 'boolean',
        'notifications_enabled' => 'boolean',
        'mobile_notifications_enabled' => 'boolean',
        'slack_webhook_enabled' => 'boolean',
        'discord_webhook_enabled' => 'boolean',
        'custom_webhook_enabled' => 'boolean',
    ];

    protected $appends = [
        'route_url',
        'feedback_script_html'
    ];

    public function getRouteUrlAttribute()
    {
        return route('panel.projects.show', $this);
    }

    public function getFeedbackScriptUrl()
    {
        return route('feedback.script', ['project' => $this->id]);
    }

    public function getFeedbackScriptHtmlAttribute()
    {
        return '<script src="' . $this->getFeedbackScriptUrl() . '"></script>';
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook;
    }

    public function routeNotificationForDiscord()
    {
        return $this->discord_webhook;
    }

    public function routeNotificationForWebhook()
    {
        return $this->custom_webhook;
    }

    public function isOwner()
    {
        return $this->pivot->owner;
    }

    public function hasNotificationChannelsEnabled()
    {
        return $this->slack_webhook || $this->discord_webhook;
    }

    public function scopeWantsEmail($query)
    {
        return $query->where('receive_email', true);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getDefaultImage($type = '')
    {
        $media = $this->getFirstMedia('projects', ['default' => true]);

        if ($media) {
            return $media->getUrl($type);
        }

        $media = $this->getFirstMedia('projects');

        if ($media) {
            return $media->getUrl($type);
        }

        return false;
    }

    public function getScreenshotAttribute()
    {
        if ($media = $this->getFirstMediaUrl('projectSiteScreenshot')) {
            return url($media);
        }

        return false;
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class)->withPivot('owner');
    }

    public function group()
    {
        return $this->belongsTo(\App\Models\ProjectGroup::class);
    }

    public function exceptions()
    {
        return $this->hasMany(\App\Models\Exception::class);
    }

    public function unreadExceptions()
    {
        return $this->exceptions()
            ->where(function ($query) {
                return $query
                    ->where('status', \App\Models\Exception::OPEN);
            });
    }

    public function feedback()
    {
        return $this->hasManyThrough(Feedback::class, Exception::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        });
    }

    public function routeNotificationForFcm()
    {
        return $this->users()->wherePivot('owner', true)->first()
            ->fcmTokens()
            ->get()
            ->map(function ($fcmToken) {
                return $fcmToken->token;
            })->toArray();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $project) {
            $project->key = str_random(50);
        });

        static::created(function (self $project) {
            if (auth()->check()) {
                auth()->user()->notify(new ProjectWasCreated($project));
            }
        });

        static::deleting(function (self $project) {
            $project->exceptions()->delete();
            $project->feedback()->delete();
        });
    }
}
