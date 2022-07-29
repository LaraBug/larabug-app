<?php

namespace App\Models;

use App\Notifications\IssueStatusUpdatedNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Kblais\Uuid\Uuid;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ProjectWasCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string slack_webhook
 * @property string discord_channel
 * @property string discord_webhook
 * @property string title
 * @property mixed pivot
 * @property boolean receive_email
 * @property boolean notifications_enabled
 * @property boolean mobile_notifications_enabled
 * @property boolean slack_webhook_enabled
 * @property boolean discord_webhook_enabled
 * @property boolean custom_webhook_enabled
 * @property boolean telegram_notifications_enabled
 * @property int telegram_chat_id
 * @property string key
 * @property mixed url
 */
class Project extends Model
{
    use Uuid,
        Filterable,
        Notifiable,
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
        'issue_receive_email',
        'issue_slack_webhook',
        'issue_discord_webhook',
        'issue_custom_webhook',
        'issue_mobile_notifications_enabled',
        'issue_slack_webhook_enabled',
        'issue_discord_webhook_enabled',
        'issue_custom_webhook_enabled',
        'telegram_notifications_enabled',
        'telegram_chat_id',
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
        'issue_receive_email' => 'boolean',
        'issue_mobile_notifications_enabled' => 'boolean',
        'issue_slack_webhook_enabled' => 'boolean',
        'issue_discord_webhook_enabled' => 'boolean',
        'issue_custom_webhook_enabled' => 'boolean',
        'telegram_notifications_enabled' => 'boolean',
        'telegram_chat_id' => 'int',
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

    public function routeNotificationForSlack($notification)
    {
        if ($notification instanceof IssueStatusUpdatedNotification) {
            return $this->issue_slack_webhook;
        }

        return $this->slack_webhook;
    }

    public function routeNotificationForDiscord($notification)
    {
        if ($notification instanceof IssueStatusUpdatedNotification) {
            return $this->issue_discord_webhook;
        }

        return $this->discord_webhook;
    }

    public function routeNotificationForWebhook($notification)
    {
        if ($notification instanceof IssueStatusUpdatedNotification) {
            return $this->issue_custom_webhook;
        }

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class)->withPivot('owner');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ProjectGroup::class);
    }

    public function exceptions(): HasMany
    {
        return $this->hasMany(\App\Models\Exception::class);
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }

    public function unreadExceptions()
    {
        return $this->exceptions()
            ->where(function ($query) {
                return $query
                    ->where('status', \App\Models\Exception::OPEN);
            });
    }

    public function feedback(): HasManyThrough
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

    public function routeNotificationForTelegram()
    {
        return $this->telegram_chat_id;
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
            $project->issues()->delete();
            $project->feedback()->delete();
        });
    }
}
