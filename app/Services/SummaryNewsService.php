<?php

namespace App\Services;

use App\Services\Contracts\SummaryNewsServiceContract;
use App\Services\OpenAi\Contracts\OpenAiServiceContract;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class SummaryNewsService implements SummaryNewsServiceContract
{
    public function __construct(protected OpenAiServiceContract $service)
    {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function handle(): void
    {
        $this->service->getSummary();
    }
}
