<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Kblais\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use Uuid;

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
}