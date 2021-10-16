<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectGroup
 *
 * @property string $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGroup whereUserId($value)
 * @mixin \Eloquent
 */
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
