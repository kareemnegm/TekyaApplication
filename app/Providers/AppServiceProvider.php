<?php

namespace App\Providers;

use App\Classes\CategoryClass;
use App\Classes\ProviderClass;
use App\Interfaces\BundelInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\CollectionInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProviderInterface;
use App\Interfaces\User\CartInterface;
use App\Interfaces\User\ShopInrerface;
use App\Repositories\BundelRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\User\ShopRepository;
use App\Interfaces\User\CategoryInterface as CategoryUserInterface;
use App\Interfaces\User\OrderInterface;
use App\Interfaces\User\UserInterface;
use App\Repositories\User\CartRepository;
use App\Repositories\User\CategoryRepository;
use App\Repositories\User\OrderRepository;
use App\Repositories\User\UserRepository;
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
        $this->app->bind(UserInterface::class, UserRepository::class);

        $this->app->bind(CategoryUserInterface::class, CategoryRepository::class);

        $this->app->bind(ShopInrerface::class, ShopRepository::class);

        $this->app->bind(OrderInterface::class, OrderRepository::class);

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
