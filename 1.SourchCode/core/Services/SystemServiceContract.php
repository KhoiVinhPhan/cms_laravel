<?php

namespace Core\Services;

interface SystemServiceContract
{
    public function pagination($input);
    public function colors($input);
    public function changeLanguage($input);
    public function editor($input);
    public function updateConfigSystem($input);
    public function getDataConfigSystem();
}