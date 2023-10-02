<?php

namespace App\Providers;

use App\Repositories\Contracts\TopHeadlinesRepositoryContract;
use App\Repositories\TopHeadlinesRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class TopHeadlinesRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            TopHeadlinesRepositoryContract::class,
            TopHeadlinesRepositoryEloquent::class,
        );
    }
}
