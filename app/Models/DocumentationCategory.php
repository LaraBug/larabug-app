<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DocumentationCategory
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $title
 * @property int $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Documentation[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentationCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DocumentationCategory extends Model
{
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
