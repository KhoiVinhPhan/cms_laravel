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

    public function storeCategory($input)
    {
        return $this->articleRepository->storeCategory($input);
    }

    public function updateCategory($input)
    {
        return $this->articleRepository->updateCategory($input);
    }

    public function store($input)
    {
        return $this->articleRepository->store($input);
    }

    public function changeStatus($input)
    {
        return $this->articleRepository->changeStatus($input);
    }

    public function allArticle($request)
    {
        return $this->articleRepository->allArticle($request);
    }

    public function getDataAricle($article)
    {
        return $this->articleRepository->getDataAricle($article);
    }

}