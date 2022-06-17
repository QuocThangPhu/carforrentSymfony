<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    public function success(array $data): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        return $jsonResponse->setData([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function error(string $message, int $status = Response::HTTP_BAD_REQUEST, array $headers = []): JsonResponse
    {
        $dataResponse = [
            'status' => 'error',
            'message' => $message
        ];
        return new JsonResponse($dataResponse, $status, $headers);
    }
}
