<?php

namespace App\Filters;

use App\Models\Exception;
use EloquentFilter\ModelFilter;

class ProjectFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function search($value)
    {
        return $this->where('title', 'like', '%' . $value . '%');
    }

    public function hasOpenExceptions($value)
    {
        if (!$value) {
            return $this;
        }

        return $this->whereHas('exceptions', function ($query) {
            return $query->where('status', Exception::OPEN);
        });
    }
}
