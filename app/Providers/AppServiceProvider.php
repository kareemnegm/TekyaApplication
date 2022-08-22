<?php

namespace App\Providers;

use App\Classes\CategoryClass;
use App\Classes\ProviderClass;
use App\Interfaces\BundelInterface;
use App\Interfaces\CartInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\CollectionInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProviderInterface;
use App\Repositories\BundelRepository;
use App\Repositories\CartRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProviderInterface::class, ProviderClass::class);
        $this->app->bind(CategoryInterface::class, CategoryClass::class);

        $this->app->bind(CollectionInterface::class, CollectionRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(BundelInterface::class, BundelRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryClass::class);


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
