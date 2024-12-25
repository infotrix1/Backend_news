<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    protected $newsModel;

    public function __construct(News $news)
    {
        $this->newsModel = $news;
    }

    public function saveNews($articleData)
    {
        $this->newsModel->upsert($articleData, ['url'], ['title', 'source', 'image_url', 'category', 'author']);

    }

    public function getNews($filters,$keyword)
    {
        $userPreferences = auth()->user()->preferences;

        if ($userPreferences) {
            $filters = array_merge($filters, $this->applyUserPreferences($userPreferences));
        }

        return News::filter($filters)
        ->search($keyword)
        ->get();
    }

    public function getFeaturedNews()
    {
        return $this->newsModel->orderBy('created_at', 'desc')->limit(5)->get();
    }

    private function applyUserPreferences($userPreferences)
    {
        $filters = [];
        $preferenceMapping = [
            'authors' => 'author',
            'sources' => 'source',
            'categories' => 'category'
        ];

        foreach ($preferenceMapping as $key => $column) {
            if (!empty($userPreferences[$key])) {
                $filters[$column] = $userPreferences[$key];
            }
        }

        return $filters;
    }


    private function getDistinctColumn($column)
    {
        return $this->newsModel->select($column)->distinct()->get();
    }

    public function categories()
    {
        return $this->getDistinctColumn('category');
    }

    public function authors()
    {
        return $this->getDistinctColumn('author');
    }
}


