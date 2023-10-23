<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Responses\ResponseBuilder;
use App\Services\NewsApi\Contracts\NewsServiceContract;
use App\Services\Contracts\SummaryNewsServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SummaryNewsController extends Controller
{
    public function __construct(private SummaryNewsServiceContract $service)
    {
        //
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = ResponseBuilder::init();

        try {
            $summary = $this->service->handle($request->all());

            return $response->data($summary)
                ->status(Response::HTTP_OK)
                ->build();
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return $response->message('Unexpected error in '.self::class)
                ->status(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->build();
        }
    }
}
