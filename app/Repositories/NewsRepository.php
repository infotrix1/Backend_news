<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    public function saveNews($articleData)
    {
        News::upsert($articleData, ['url'], ['title', 'source', 'image_url', 'category', 'author']);

    }
}


