<?php

namespace Core\Repositories;

interface ArticleRepositoryContract
{
    public function category();
    public function storeCategory($input);
    public function updateCategory($input);
    public function store($input);
    public function changeStatus($input);
    public function allArticle($request);
    public function getDataAricle($article);
    public function update($input);
}