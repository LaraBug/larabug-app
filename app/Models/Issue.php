<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kblais\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use Uuid;

    protected $appends = [
        'exceptions_count',
    ];

    protected $guarded = [
        'id',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'last_exception_at' => 'date',
    ];

    public function exceptions(): HasMany
    {
        return $this->hasMany(Exception::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('exception', 'like', '%' . $search . '%');
            });
        });
    }

    public function getExceptionsCountAttribute(): int
    {
        return $this->exceptions()->count();
    }
}