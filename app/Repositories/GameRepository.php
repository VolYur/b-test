<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

class GameRepository
{
    public function save(int $userId, int $number, float $sum, bool $result): Game
    {
        $game = new Game();

        $game->user_id = $userId;
        $game->number = $number;
        $game->sum = $sum;
        $game->result = $result;

        $game->save();

        return $game;
    }

    public function getLastThree(int $userId): Collection
    {
        return Game::query()->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();
    }
}
