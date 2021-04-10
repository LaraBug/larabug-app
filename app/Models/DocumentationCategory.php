<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentationCategory extends Model
{
    public function items()
    {
        return $this->hasMany(Documentation::class);
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
