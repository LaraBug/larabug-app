<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
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
        'last_error_at',
    ];

    protected $appends = [
        'status_text',
        'human_date',
        'exception_count',
        'affected_versions',
    ];

    public $dates = [
        'last_error_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (!$model->status) {
                $model->status = self::OPEN;
            }
        });

        self::created(function ($model) {
            $data = [
                'issue_id' => $model->id,
                'action' => 'created',
                'causer' => 'LaraBug',
                'content' => 'First occurred so created a new issue',
            ];

            ray('Test');

            $issueEvent = IssueEvent::create($data);

            ray($issueEvent);
        });
    }

    public function getHumanDateAttribute()
    {
        if (!$this->last_error_at) {
            return '';
        }

        return $this->last_error_at->diffForHumans();
    }

    public function getStatusTextAttribute()
    {
        return trans('status.' . strtoupper($this->status));
    }

    public function getAffectedVersionsAttribute()
    {
        $versions = $this->exceptions()
            ->distinct('project_version')
            ->pluck('project_version')
            ->toArray();

        return implode(', ', $versions);
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
    public function events()
    {
        return $this->hasMany(IssueEvent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exceptions()
    {
        return $this->hasMany(Exception::class);
    }

    public function getExceptionCountAttribute()
    {
        return $this->exceptions->count();
    }

    public function log($action, $content, $causer = 'LaraBug')
    {
        $data = [
            'issue_id' => $this->id,
            'action' => $action,
            'content' => $content,
            'causer' => $causer,
        ];

        return IssueEvent::create($data);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('exception', 'like', '%' . $search . '%');
            });
        });
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
