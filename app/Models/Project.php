<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Projects\GetSiteScreenshot;
use App\Notifications\ProjectWasCreated;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string slack_webhook
 * @property string discord_channel
 * @property string discord_webhook
 * @property string title
 * @property mixed pivot
 * @property boolean receive_email
 * @property string key
 * @property mixed url
 */
class Project extends Model implements HasMedia
{
    use Uuid,
        Filterable,
        Notifiable,
        InteractsWithMedia;

    protected $fillable = [
        'url',
        'title',
        'description',
        'receive_email',
        'slack_webhook',
        'discord_webhook'
    ];

    protected $dates = [
        'last_exception_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'receive_email' => 'boolean'
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
        return '<script src="'. $this->getFeedbackScriptUrl(). '"></script>';
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook;
    }

    public function routeNotificationForDiscord()
    {
        return $this->discord_webhook;
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
                $query->where('title', 'like', '%'.$search.'%');
            });
        });
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
