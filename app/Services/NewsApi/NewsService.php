<?php

namespace App\Services\NewsApi;

use App\Models\News;
use App\Repositories\Contracts\NewsRepositoryContract;
use App\Services\NewsApi\Contracts\NewsApiServiceContract;
use App\Services\NewsApi\Contracts\NewsServiceContract;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;

class NewsService implements NewsServiceContract
{
    /**
     * @param  NewsApiServiceContract  $service
     * @param  NewsRepositoryContract  $newsRepository
     */
    public function __construct(
        private NewsApiServiceContract $service,
        private NewsRepositoryContract $newsRepository
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getAllArticlesAbout(array $dataRequest): array
    {
        try {
            $queryString = http_build_query($dataRequest['query']);

            $response = $this->service->getAllArticlesAbout($queryString);

            //$responseJson = json_decode($response->getBody()->getContents(), true);

            foreach ($response as $articles) {
                $this->newsRepository->updateOrCreate(
                    [
                        'url' => $articles['url']
                    ],
                    [
                        'sourceId' => $articles['source']['id'],
                        'sourceName' => $articles['source']['name'],
                        'author' => $articles['author'],
                        'title' => $articles['title'],
                        'description' => $articles['author'],
                        'url' => $articles['url'],
                        'urlToImage' => $articles['urlToImage'],
                        'publishedAt' => $articles['publishedAt'],
                        'content' => $articles['content'],
                    ]
                );
            }

            return [];
        } catch (RequestException $exception) {
            return $this->formatExceptionResponse($exception->getResponse());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getTopHeadlinesInTheCountry(array $dataRequest): array
    {
        try {
            $queryString = http_build_query($dataRequest);

            $response = $this->service->getTopHeadlinesInTheCountry($queryString);

            return $this->formatResponse($response);
        } catch (RequestException $exception) {
            return $this->formatExceptionResponse($exception->getResponse());
        }
    }

    /**
     * @param  ResponseInterface  $response
     * @return array
     */
    private function formatResponse(ResponseInterface $response): array
    {
        $status = $response->getStatusCode();
        $data = json_decode($response->getBody()->getContents(), true);
        $responseData = ['data' => $data['data'] ?? $data ?? []];

        switch ($status) {
            case Response::HTTP_OK:
                $responseData['success'] = true;
                break;
            default:
                $responseData['success'] = false;
                break;
        }

        return $responseData;
    }

    /**
     * @param  ResponseInterface  $response
     * @return array
     */
    private function formatExceptionResponse(ResponseInterface $response): array
    {
        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'success' => false,
            'message' => $data['message'] ?? 'No service response',
            'data' => $data['data'] ?? $data ?? [],
        ];
    }
}
