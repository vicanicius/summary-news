<?php

namespace App\Services\NewsApi;

use App\Services\NewsApi\Contracts\ApiClientContract;
use GuzzleHttp\Client;

class ApiClient extends Client implements ApiClientContract
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
}
