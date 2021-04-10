<?php namespace App\Filters;

use EloquentFilter\ModelFilter;

class ExceptionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relatedModel => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function search($search)
    {
        return $this->where('exception', 'LIKE', '%' . $search . '%');
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function hasFeedback($value)
    {
        return $this->whereHas('feedback');
    }
}
