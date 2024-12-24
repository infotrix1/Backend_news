<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    public function saveNews($articleData)
    {
        News::upsert($articleData, ['url'], ['title', 'source', 'image_url', 'category', 'author']);

    }

    public function getNews($filters,$keyword)
    {
        $news = News::filter($filters)->search($keyword)->get();
        return $news;
    }

    public function categories()
    {
        $categories = News::select('category')->distinct()->get();
        return $categories;
    }

    public function authors()
    {
        $authors = News::select('author')->distinct()->get();
        return $authors;
    }
}


