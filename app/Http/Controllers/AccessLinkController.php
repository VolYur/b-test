<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Services\AccessLinkDeactivationService;
use App\Services\AccessLinkGenerationService;
use Illuminate\Http\JsonResponse;

class AccessLinkController
{
    public function deactivate(Request $request, AccessLinkDeactivationService $accessLinkDeactivationService): JsonResponse
    {
        try {
            $accessLinkDeactivationService->deactivate($request->getUserByToken()->id);

            return new JsonResponse(
                ['result' => true, 'data' => []],
            );
        } catch (\Throwable $exception) {
            return new JsonResponse(
                [
                    'result' => false,
                    'message' => $exception->getMessage(),
                    'data' => []
                ],
            );
        }
    }

    public function regenerate(Request $request, AccessLinkGenerationService $accessLinkGenerationService): JsonResponse
    {
        try {
            $accessLink = $accessLinkGenerationService->generate($request->getUserByToken()->id);

            return new JsonResponse(
                [
                    'result' => true,
                    'data' => [
                        'linkToken' => $accessLink->token,
                    ]
                ],
            );
        } catch (\Throwable $exception) {
            return new JsonResponse(
                [
                    'result' => false,
                    'message' => $exception->getMessage(),
                    'data' => []
                ],
            );
        }
    }
}
