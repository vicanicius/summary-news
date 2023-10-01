<?php

namespace App\Providers;

use App\Services\NewsApi\Contracts\NewsApiServiceContract;
use App\Services\NewsApi\NewsApiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class NewsApiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(NewsApiServiceContract::class, NewsApiService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [NewsApiServiceContract::class];
    }
}
