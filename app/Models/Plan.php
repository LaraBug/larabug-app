<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * @property bool default
 */
class Plan extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'max_emails',
        'max_projects',
        'max_retention_in_days',
        'max_exceptions_per_minute',
        'has_group_management'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isDefaultPlan()
    {
        return $this->default;
    }
}
