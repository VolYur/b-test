<?php

namespace App\Http\Middleware;

use App\Models\AccessLink;
use App\Models\User;
use App\Services\AccessLinkValidationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var AccessLinkValidationService $accessLinkValidationService */
        $accessLinkValidationService = app()->make(AccessLinkValidationService::class);
        $token = $request->header('token');
        if (!$accessLinkValidationService->validate((string) $token)) {
            abort(response()->json([], 403));
        }

        return $next($request);
    }
}
