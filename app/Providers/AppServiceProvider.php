<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\PostInterface;
use App\Repository\Eloquent\PostEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostInterface::class, PostEloquent::class);
    }
}
