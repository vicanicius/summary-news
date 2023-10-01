<?php

namespace App\Providers;

use App\Services\NewsApi\ApiClient;
use App\Services\NewsApi\Contracts\ApiClientContract;
use GuzzleHttp\RequestOptions;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ApiClientServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            ApiClientContract::class,
            fn () => new ApiClient([
                'base_uri' => config('services.newsApi.url'),
                RequestOptions::HEADERS => [
                    'X-Api-Key' => config('services.newsApi.token'),
                    'Content-Type' => 'application/json',
                ],
            ])
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [FpayClientContract::class];
    }
}
