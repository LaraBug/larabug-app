<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use Illuminate\Support\Collection;
use App\Models\Concerns\HasSparklines;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    use Uuid, HasSparklines;

    protected $appends = [
        'exceptions_count',
        'affected_versions',
    ];

    protected $guarded = [
        'id',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'last_exception_at' => 'datetime',
        'labels' => 'json',
    ];

    public function exceptions(): HasMany
    {
        return $this->hasMany(Exception::class);
    }

    public function first_exception(): BelongsTo
    {
        return $this->belongsTo(Exception::class, 'exception_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('exception', 'like', '%' . $search . '%');
            });
        });
    }

    public function getAffectedVersionsAttribute()
    {
        $versions = $this->exceptions()
            ->distinct('project_version')
            ->pluck('project_version')
            ->toArray();

        return implode(', ', $versions);
    }

    public function getLabelsAttribute(): Collection
    {
        if (!$this->attributes['labels']) {
            return collect();
        }

        return collect(json_decode($this->attributes['labels'], true))
            ->map(function ($label) {
                return [
                    'bgColor' => $label['color'],
                    'textColor' => text_color_for_hex($label['color']),
                    'text' => $label['name'],
                ];
            });
    }

    public function getExceptionsCountAttribute(): int
    {
        return $this->exceptions()->count();
    }
}