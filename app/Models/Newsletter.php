<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'subject',
        'content'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
