<?php

namespace App\Services\NewsApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

interface NewsApiServiceContract
{
    /**
     * @param  string  $query
     * @return ResponseInterface
     *
     * @throws GuzzleException
     */
    public function getAllArticlesAbout(string $query): ResponseInterface;

    /**
     * @param  string  $country
     * @return ResponseInterface
     *
     * @throws GuzzleException
     */
    public function getTopHeadlinesInTheCountry(string $country): ResponseInterface;
}
