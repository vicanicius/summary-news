<?php

namespace App\Services\NewsApi\Contracts;

interface NewsServiceContract
{
    /**
     * @param  array  $dataRequest
     * @return array
     */
    public function getAllArticlesAbout(array $dataRequest): array;

    /**
     * @param  array  $dataRequest
     * @return array
     */
    public function getTopHeadlinesInTheCountry(array $dataRequest): array;
}
