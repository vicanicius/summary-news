<?php

namespace App\Providers;

use App\Services\NewsApi\Contracts\NewsServiceContract;
use App\Services\NewsApi\NewsService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(NewsServiceContract::class, NewsService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [NewsServiceContract::class];
    }
}
