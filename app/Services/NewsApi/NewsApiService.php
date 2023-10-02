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
    public function getAllArticlesAbout(string $query): array
    {
        $totalPerPage = 100;

        $currentPage = 1;

        $response = $this->client->request('GET', config('news-api.v2.everything.get').$query);

        $results = [];

        $totalResults = json_decode($response->getBody(), true)['totalResults'];

        $totalPages = (int) floor($totalResults / $totalPerPage);

        do {
            $queryWithPage = $query . '&page=' . $currentPage;
            $response = $this->client->request('GET', config('news-api.v2.everything.get') . $queryWithPage);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                $results = array_merge($results, $data['articles']);

                $currentPage++;
            } else {
                break;
            }
        } while ($currentPage <= $totalPages);

        return $results;
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

    private function getProductsUri(int $page): string
    {
        $uri = config('news-api.v2.everything.get');
        $uri .= '?page=' . $page;

        return $uri;
    }
}
