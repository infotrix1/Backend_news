<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function saveNews($articleData);

    public function getNews($filters, $keyword);

    public function getFeaturedNews();

    public function categories();

    public function authors();
}
