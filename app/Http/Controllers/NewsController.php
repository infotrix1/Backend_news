<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;
use Exception;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function fetchNews(Request $request)
    {
        try {
            $news = $this->newsService->getNews($request);
            return response()->json($news);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function featuredNews()
    {
        try {
            $featured_news = $this->newsService->getFeaturedNews();
            return response()->json($featured_news);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function category()
    {
        try {
            $category = $this->newsService->getCategories();
            return response()->json($category);
         } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
         }
     }

     public function authors()
     {
        try {
            $author = $this->newsService->getAuthors();
            return response()->json($author);
         } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 400);
        }
     }

}
