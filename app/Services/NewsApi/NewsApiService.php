<?php

namespace App\Services\NewsApi;

use App\Services\NewsApi\Contracts\ApiClientContract;
use App\Services\NewsApi\Contracts\NewsApiServiceContract;
use Psr\Http\Message\ResponseInterface;

class NewsApiService implements NewsApiServiceContract
{
    /**
     * @param  ApiClientContract  $client
     */
    public function __construct(private ApiClientContract $client)
    {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getAllArticlesAbout(string $query): ResponseInterface
    {
        $query = $query;
        return $this->client->request(
            'GET',
            config('news-api.v2.everything.get').$query,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getTopHeadlinesInTheCountry(string $country): ResponseInterface
    {
        return $this->client->request(
            'GET',
            config('news-api.v2.top-headlines.get').$country,
        );
    }
}
