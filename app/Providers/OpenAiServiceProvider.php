<?php

namespace App\Providers;

use App\Services\OpenAi\OpenAiService;
use App\Services\OpenAi\Contracts\OpenAiServiceContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class OpenAiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(OpenAiServiceContract::class, OpenAiService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [OpenAiServiceContract::class];
    }
}
