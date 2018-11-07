<?php

namespace Core\Repositories;

interface SystemRepositoryContract
{
    public function pagination($input);
    public function colors($input);
    public function changeLanguage($input);
    public function editor($input);
}