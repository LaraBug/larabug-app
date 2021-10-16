<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ExceptionWasCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Exception
 *
 * @property string $id
 * @property string|null $host
 * @property string|null $method
 * @property string|null $fullUrl
 * @property string|null $previousUrl
 * @property array|null $executor
 * @property string|null $exception
 * @property string|null $environment
 * @property array|null $additional
 * @property string|null $error
 * @property string|null $line
 * @property array|null $storage
 * @property string|null $file
 * @property string $file_type
 * @property string|null $class
 * @property array|null $user
 * @property string|null $status
 * @property bool $mailed
 * @property string|null $project_id
 * @property string|null $publish_password
 * @property string|null $publish_hash
 * @property string|null $project_version
 * @property string|null $published_at
 * @property string|null $snooze_until
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feedback[] $feedback
 * @property-read int|null $feedback_count
 * @property-read mixed $executor_output
 * @property-read mixed $human_date
 * @property-read mixed $markup_language
 * @property-read string|null $public_route_url
 * @property-read mixed $route_url
 * @property-read mixed $short_exception_text
 * @property-read mixed $status_text
 * @property-read \Illuminate\Database\Eloquent\Collection|Exception[] $occurences
 * @property-read int|null $occurences_count
 * @property-read \App\Models\Project|null $project
 * @method static \Database\Factories\ExceptionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception new()
 * @method static \Illuminate\Database\Eloquent\Builder|Exception newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exception newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exception notMailed()
 * @method static \Illuminate\Database\Eloquent\Builder|Exception paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exception simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereAdditional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereEnvironment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereExecutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereFullUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereMailed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception wherePreviousUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereProjectVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception wherePublishHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception wherePublishPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereSnoozeUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exception whereUser($value)
 * @mixin \Eloquent
 */
class Exception extends Model
{
    use Uuid,
        Filterable,
        HasFactory;

    /**
     * Status vars
     */
    const OPEN = 'OPEN';
    const READ = 'READ';
    const FIXED = 'FIXED';
    const DONE = 'DONE';

    /**
     * @var array
     */
    protected $guarded = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user' => 'array',
        'storage' => 'array',
        'executor' => 'array',
        'mailed' => 'boolean',
        'additional' => 'array'
    ];

    protected $appends = [
        'human_date',
        'public_route_url',
        'route_url',
        'status_text',
        'short_exception_text',
        'executor_output',
        'markup_language'
    ];

    public function getHumanDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getRouteUrlAttribute()
    {
        return route('panel.exceptions.show', [$this->project_id, $this]);
    }

    public function getPublicRouteUrlAttribute(): ?string
    {
        if (! $this->publish_hash) {
            return null;
        }

        return route('public.exception', $this);
    }

    public function getStatusTextAttribute()
    {
        return trans('status.' . strtoupper($this->status));
    }

    public function getMarkupLanguageAttribute()
    {
        $pathinfo = pathinfo($this->file);

        $extension = array_get($pathinfo, 'extension');

        if ($extension == 'php') {
            return 'language-php';
        }

        if ($extension == 'html') {
            return 'language-html';
        }

        // Default to php..
        return 'language-php';
    }

    public function getExecutorOutputAttribute()
    {
        // strip all the html on the line, replace the line number
        // with nothing(the frontend will do the line numbers for us)
        // and output as one giant string
        return join(PHP_EOL, collect($this->executor)->map(function ($line) {
            return preg_replace(
                "/^[0-9]{1,}[.]/i",
                "",
                str_replace(
                    "\n",
                    "",
                    array_get($line, 'line')
                )
            );
        })->toArray());
    }

    public function getShortExceptionTextAttribute()
    {
        if (!$this->exception) {
            return '-No exception text-';
        }

        return str_limit($this->exception, 75);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeNotMailed($query)
    {
        return $query->whereMailed(false);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeNew($query)
    {
        return $query->whereStatus(self::OPEN);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function occurences()
    {
        return $this->hasMany(self::class, 'exception', 'exception')
            ->whereRaw('id != exceptions.id and line = exceptions.line and project_id = exceptions.project_id')
            ->where('created_at', '>', now()->subMonth());
    }

    /**
     *
     */
    public function markAsRead()
    {
        $this->status = self::READ;
        $this->save();
    }

    /**
     * @param string $status
     */
    public function markAs($status = self::FIXED)
    {
        $this->status = $status;
        $this->save();

        if ($status == self::FIXED) {
            Statistic::incrementStatistics('total_fixed_exceptions');
        }
    }

    /**
     * Mark as e-mailed, whenever this status is true it will not be e-mailed out to the user.
     */
    public function markAsMailed()
    {
        $this->mailed = true;
        $this->save();
    }

    public function isMarkedAsMailed()
    {
        return $this->mailed;
    }

    public function makePublic()
    {
        $this->publish_hash = str_random(15);
        $this->published_at = carbon();
        $this->save();

        return $this;
    }

    public function removePublic()
    {
        $this->publish_hash = null;
        $this->published_at = null;
        $this->save();

        return $this;
    }

    public function isPublic()
    {
        return $this->publish_hash ? true : false;
    }

    public function snooze(int $minutes)
    {
        $this->snooze_until = now()->addMinutes($minutes);
        $this->save();

        return true;
    }

    public function unsnooze()
    {
        $this->snooze_until = null;
        $this->save();

        return true;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function isGitCommit()
    {
        return strlen($this->project_version) === 7;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($exception) {
            $exception->status = self::OPEN;
        });

        static::created(function ($exception) {
            if ($exception->project->notifications_enabled) {
                $exception->project->notify(new ExceptionWasCreated($exception));
            }
        });
    }
}
