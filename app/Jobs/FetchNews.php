<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\NewsService;

class FetchNews implements ShouldQueue
{
    use Queueable;
    protected $newsService;

    /**
     * Create a new job instance.
     */
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->newsService->fetchGuardianNews();
        $this->newsService->fetchNYTNews();
        $this->newsService->fetchNewsApi();
        $this->info('News fetched and saved successfully!');
    }
}
