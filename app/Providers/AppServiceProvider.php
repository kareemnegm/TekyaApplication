<?php

namespace App\Providers;

use App\Classes\CategoryClass;
use App\Classes\ProviderClass;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ProviderInterface;
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
