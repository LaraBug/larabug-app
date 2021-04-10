<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
    use Uuid;

    protected $fillable = [
        'title',
        'description'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'group_id');
    }
}
