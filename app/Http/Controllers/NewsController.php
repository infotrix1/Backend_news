<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function fetchNews()
    {
        // Fetch news from both sources
        $this->newsService->fetchGuardianNews();
        // $this->newsService->fetchNYTNews();
        // $this->newsService->fetchNewsApi();

        return response()->json(['message' => 'News Record Inserted Successfully']);
    }

}
