<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;

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
    public function exceptions()
    {
        return $this->hasMany(Exception::class);
    }

    public function getExceptionCountAttribute()
    {
        return $this->exceptions->count();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('exception', 'like', '%' . $search . '%');
            });
        });
    }
}
