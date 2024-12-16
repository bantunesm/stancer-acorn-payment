<?php

namespace StancerLaravel\Traits;

use Illuminate\Http\JsonResponse;
use Stancer\Exceptions\Exception as StancerException;

trait HandlesStancerErrors
{
    public function handleStancerException(StancerException $exception): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $exception->getMessage(),
        ], 500);
    }
}