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
        // $news = $this->newsModel->filter($filters)->search($keyword)->get();
        // return $news;

        return News::filter($filters)
        ->search($keyword)
        ->get();
    }

    private function applyUserPreferences($userPreferences)
    {
        $filters = [];

        // Apply author filters if they are provided in the user preferences
        if (isset($userPreferences['authors']) && !empty($userPreferences['authors'])) {
            $filters['author'] = $userPreferences['authors'];
        }

        // Apply source filters if they are provided in the user preferences
        if (isset($userPreferences['sources']) && !empty($userPreferences['sources'])) {
            $filters['source'] = $userPreferences['sources'];
        }

        // Apply category filters if they are provided in the user preferences
        if (isset($userPreferences['categories']) && !empty($userPreferences['categories'])) {
            $filters['category'] = $userPreferences['categories'];
        }

        return $filters;
    }


    public function categories()
    {
        $categories = $this->newsModel->select('category')->distinct()->get();
        return $categories;
    }

    public function authors()
    {
        $authors = $this->newsModel->select('author')->distinct()->get();
        return $authors;
    }
}


