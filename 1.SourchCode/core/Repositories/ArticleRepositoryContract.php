<?php

namespace Core\Repositories;

interface ArticleRepositoryContract
{
    public function category();
    public function storeCategory($input);
    public function updateCategory($input);
}