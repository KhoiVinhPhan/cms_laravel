<?php

namespace Core\Services;

use Core\Repositories\SystemRepositoryContract;

class SystemService implements SystemServiceContract
{
    protected $systemRepository;

    public function __construct(SystemRepositoryContract $systemRepository)
    {
        return $this->systemRepository = $systemRepository;
    }

    public function pagination($input)
    {
        return $this->systemRepository->pagination($input);
    }

    public function colors($input)
    {
        return $this->systemRepository->colors($input);
    }

    public function changeLanguage($input)
    {
        return $this->systemRepository->changeLanguage($input);
    }

}