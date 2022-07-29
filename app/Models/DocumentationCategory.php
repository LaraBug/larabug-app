<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class DocumentationCategory extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function items()
    {
        return $this
            ->hasMany(Documentation::class)
            ->orderBy('order_column');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $documentationCategory) {
            $documentationCategory->slug = str_slug($documentationCategory->title);
        });

        static::deleting(function (self $documentationCategory) {
            $documentationCategory->items()->delete();
        });
    }
}
