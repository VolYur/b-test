<?php

namespace App\Services;

use App\Models\AccessLink;

class AccessLinkDeactivationService
{
    public function deactivate(int $userId): void
    {
        AccessLink::query()->where('user_id', $userId)->delete();
    }
}
