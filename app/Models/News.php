<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class News extends Model
{
    use Filterable;

    protected $fillable = ['title', 'source', 'url', 'image_url', 'category', 'author'];

    public function scopeSearch($query, $search)
    {
        if (!is_null($search)) {
            return $query->where('title', 'like', '%' . $search . '%');
        }
    }

}
