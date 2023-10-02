<?php

namespace App\Services\NewsApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

interface NewsApiServiceContract
{
    /**
     * @param  string  $query
     * @return array
     *
     * @throws GuzzleException
     */
    public function getAllArticlesAbout(string $query): array;

    /**
     * @param  string  $country
     * @return array
     *
     * @throws GuzzleException
     */
    public function getTopHeadlinesInTheCountry(string $country): array;
}
