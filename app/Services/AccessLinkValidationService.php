<?php

namespace App\Services;

use App\Models\AccessLink;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AccessLinkValidationService
{
    public function validate(string $token): bool
    {
        return AccessLink::query()->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->exists();
    }
}
