<?php

namespace App\Providers;

use App\Repositories\Contracts\NewsRepositoryContract;
use App\Repositories\NewsRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class NewsRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            NewsRepositoryContract::class,
            NewsRepositoryEloquent::class,
        );
    }
}
