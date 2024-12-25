<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function saveNews($articleData);

    public function getNews($filters, $keyword);

    public function categories();

    public function authors();
}
