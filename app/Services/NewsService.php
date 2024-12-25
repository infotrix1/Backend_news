<?php

namespace App\Services;

use App\Repositories\NewsRepositoryInterface;
use Illuminate\Support\Facades\Http;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function fetchGuardianNews()
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'api-key' => env('GUARDIAN_API_KEY'),
            'show-fields' => 'thumbnail',
        ]);

        $articles = $response->json()['response']['results'];

        $articleData = [];

        foreach ($articles as $article) {
            $articleData[] = [
                'title' => $article['webTitle'],
                'url' => $article['webUrl'],
                'image_url' => $article['fields']['thumbnail'] ?? null,
                'category' => $article['sectionName'],
                'author' => $article['fields']['byline'] ?? null,
                'source' => 'The Guardian',
            ];
        }

        if (!empty($articleData)) {
            $this->newsRepository->saveNews($articleData);
        }
    }

    public function fetchNYTNews()
    {
        $response = Http::get('https://api.nytimes.com/svc/topstories/v2/home.json', [

            'api-key' => env('NYT_API_KEY'),
        ]);


        $articles = $response->json()['results'];

        $articleData = [];

        foreach ($articles as $article) {
            $articleData[] = [
                'title' => $article['title'],
                'url' => $article['url'],
                'image_url' => $this->getImageUrl($article),
                'category' => $article['section'] ?? null,
                'author' => $article['byline'] ?? null,
                'source' => 'New York Times',
            ];
        }

        if (!empty($articleData)) {
            $this->newsRepository->saveNews($articleData);
        }
    }

    public function fetchNewsApi()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => env('NEWS_API_KEY'),
            'language' => 'en',
        ]);

        $articles = $response->json()['articles'];

        $articleData = [];

        foreach ($articles as $article) {
            $articleData[] = [
                'title' => $article['title'],
                'url' => $article['url'],
                'image_url' => $article['urlToImage'] ?? null,
                'category' => $article['category'] ?? null,
                'author' => $article['author'] ?? null,
                'source' => 'News Api',
            ];
        }

        if (!empty($articleData)) {
            $this->newsRepository->saveNews($articleData);
        }
    }

    protected function getImageUrl($article)
    {
        if (isset($article['multimedia']) && count($article['multimedia']) > 0) {
            return 'https://static01.nyt.com/' . $article['multimedia'][0]['url'];
        }
        return null;
    }


    public function getNews($request)
    {
        $filters = $request->get('filters') ?? [];
        $keyword = $request->get('keyword')??"";
        return $this->newsRepository->getNews($filters, $keyword);
    }

    public function getCategories()
    {
        return $this->newsRepository->categories();
    }

    public function getAuthors()
    {
        return $this->newsRepository->authors();
    }

}

