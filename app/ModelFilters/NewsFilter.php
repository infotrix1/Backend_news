<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class NewsFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function source($search)
    {
        return $this->where(function($q) use ($search)
        {
            return $q->whereIn('source',$search);
        });

    }

    public function author($search)
    {
        return $this->where(function($q) use ($search)
        {
            return $q->whereIn('author',$search);
        });
    }

    public function category($search)
    {
        return $this->where(function($q) use ($search)
        {
            return $q->whereIn('category',$search);
        });
    }
}
