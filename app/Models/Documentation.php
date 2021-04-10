<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class Documentation extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'title',
        'content'
    ];

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(DocumentationCategory::class, 'documentation_category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $documentation) {
            $documentation->slug = str_slug($documentation->title);
        });
    }
}
