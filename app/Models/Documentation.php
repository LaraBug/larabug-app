<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Models\Documentation
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $content
 * @property int $default
 * @property int $order_column
 * @property int|null $documentation_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DocumentationCategory|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereDocumentationCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documentation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
