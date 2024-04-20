<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interface\BrandInterface',
            'App\Repositories\BrandRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\AttributeInterface',
            'App\Repositories\AttributeRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\AttributeValueInterface',
            'App\Repositories\AttributeValueRepositories',
        );
        $this->app->bind(
            'App\Repositories\Interface\LanguageInterface',
            'App\Repositories\LanguageRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\BlogCategoryInterface',
            'App\Repositories\BlogCategoryRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\CategoryInterface',
            'App\Repositories\CategoryRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\BlogTagInterface',
            'App\Repositories\BlogTagRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\BlogPostInterface',
            'App\Repositories\BlogPostRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\StaffInterface',
            'App\Repositories\StaffRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\UnitInterface',
            'App\Repositories\UnitRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\SliderInterface',
            'App\Repositories\SliderRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\FaqInterface',
            'App\Repositories\FaqRepositories'
        );
        $this->app->bind(
            'App\Repositories\Interface\ColorInterface',
            'App\Repositories\ColorRepositories'
        );
    }
}
