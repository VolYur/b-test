<?php

namespace App\Services;

use App\Models\Game;
use App\Repositories\GameRepository;

class PlayGameService
{
    public function __construct(private GameRepository $gameRepository)
    {
    }

    public function play(int $userId): Game
    {
        $number = rand(1, 1000);

        $isWinner = $this->isWinner($number);

        $sumAmount = $isWinner ? $this->calculateWinSum($number) : 0;;

        return $this->gameRepository->save($userId, $number, $sumAmount, $isWinner);
    }

    private function isWinner(int $number): bool
    {
        return $number % 2 === 0;
    }

    private function calculateWinSum(int $number): float
    {
        if ($number > 900) {
            return $number * 0.7;
        }

        if ($number > 600) {
            return $number * 0.5;
        }

        if ($number > 300) {
            return $number * 0.3;
        }

        return $number * 0.1;
    }
}
