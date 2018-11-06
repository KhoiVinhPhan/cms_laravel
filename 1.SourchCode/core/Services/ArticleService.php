<?php

namespace Core\Services;

use Core\Repositories\ArticleRepositoryContract;

class ArticleService implements ArticleServiceContract
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryContract $articleRepository)
    {
        return $this->articleRepository = $articleRepository;
    }

    public function category()
    {
        return $this->articleRepository->category();
    }

}