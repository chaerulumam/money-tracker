<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryImplement;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\UserRepositoryImplement;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // registered the Repository Pattern
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryImplement::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepositoryImplement::class);

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
