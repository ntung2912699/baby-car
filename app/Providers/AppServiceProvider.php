<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Repositories\Attribute\AttributeRepositoryInterface::class,
            \App\Repositories\Attribute\AttributeRepository::class,

            \App\Repositories\AttributeSpec\AttributeSpecRepositoryInterface::class,
            \App\Repositories\AttributeSpec\AttributeSpecRepository::class,

            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class,

            \App\Repositories\Producer\ProducerRepositoryInterface::class,
            \App\Repositories\Producer\ProducerRepository::class,

            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class,

            \App\Repositories\Roles\RolesRepositoryInterface::class,
            \App\Repositories\Roles\RolesRepository::class,

            \App\Repositories\Service\ServiceRepositoryInterface::class,
            \App\Repositories\Service\ServiceRepository::class,

            \App\Repositories\SocialAccount\SocialAccountRepositoryInterface::class,
            \App\Repositories\SocialAccount\SocialAccountRepository::class,

            \App\Repositories\Status\StatusRepositoryInterface::class,
            \App\Repositories\Status\StatusRepository::class,

            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,

            \App\Repositories\ProductModel\ProductModelRepositoryInterface::class,
            \App\Repositories\ProductModel\ProductModelRepository::class,

            \App\Repositories\Visitor\VisitorRepositoryInterface::class,
            \App\Repositories\Visitor\VisitorRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url)
    {
//        URL::forceScheme('https');
    }
}
