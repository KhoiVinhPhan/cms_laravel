<?php
namespace Core\Providers;
use Illuminate\Support\ServiceProvider;

use Core\Repositories\UserRepository;
use Core\Repositories\UserRepositoryContract;
use Core\Services\UserService;
use Core\Services\UserServiceContract;

use Core\Repositories\SystemRepository;
use Core\Repositories\SystemRepositoryContract;
use Core\Services\SystemService;
use Core\Services\SystemServiceContract;

use Core\Repositories\ArticleRepository;
use Core\Repositories\ArticleRepositoryContract;
use Core\Services\ArticleService;
use Core\Services\ArticleServiceContract;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserServiceContract::class, UserService::class);

        $this->app->bind(SystemRepositoryContract::class, SystemRepository::class);
        $this->app->bind(SystemServiceContract::class, SystemService::class);

        $this->app->bind(ArticleRepositoryContract::class, ArticleRepository::class);
        $this->app->bind(ArticleServiceContract::class, ArticleService::class);
    }
}