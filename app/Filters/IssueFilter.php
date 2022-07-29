<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class IssueFilter extends ModelFilter
{
    public $relations = [];

    public function search($value)
    {
        return $this->where('exception', 'like', '%' . $value . '%');
    }
}