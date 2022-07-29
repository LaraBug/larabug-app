<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use EloquentFilter\Filterable;
use App\Models\Concerns\HasSparklines;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Issue extends Model
{
    use Uuid, Filterable, HasSparklines;

    protected $guarded = [
        'id',
        'updated_at',
    ];

    protected $casts = [
        'last_occurred_at' => 'datetime',
    ];

    protected $appends = [
        'status_text',
        'last_occurred_at_human',
    ];

    public function exceptions(): HasMany
    {
        return $this->hasMany(Exception::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function unreadExceptions()
    {
        return $this->exceptions()
            ->where(function ($query) {
                return $query
                    ->where('status', \App\Models\Exception::OPEN);
            });
    }

    public function getStatusTextAttribute()
    {
        return trans('status.' . strtoupper($this->status));
    }

    public function getLastOccurredAtHumanAttribute()
    {
        return $this->last_occurred_at->diffForHumans();
    }
}