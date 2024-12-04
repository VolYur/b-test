<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\AccessLink;
use App\Models\Game;
use App\Repositories\GameRepository;
use App\Services\AccessLinkValidationService;
use App\Services\PlayGameService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GameController
{
    public function index(string $token, AccessLinkValidationService $accessLinkValidationService)
    {
        if (!$accessLinkValidationService->validate($token)) {
            throw new AccessDeniedHttpException();
        }

        return view('game.main', [
            'linkToken' => AccessLink::query()->where('token', $token)->first()->token,
        ]);
    }

    public function play(Request $request, PlayGameService $playGameService): JsonResponse
    {
        $game = $playGameService->play($request->getUserByToken()->id);
        return new JsonResponse(
            [
                'result' => true,
                'data' => [
                    'number' => $game->number,
                    'sum' => $game->sum,
                    'result' => $game->result,
                ]
            ],
        );
    }

    public function history(Request $request, GameRepository $gameRepository): JsonResponse
    {
        return new JsonResponse(
            [
                'result' => true,
                'data' => $gameRepository->getLastThree($request->getUserByToken()->id)
                    ->map(function (Game $game) {
                        return [
                            'number' => $game->number,
                            'sum' => $game->sum,
                            'result' => $game->result,
                        ];
                    })->toArray()
            ],
        );
    }
}
