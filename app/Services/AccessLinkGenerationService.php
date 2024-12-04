<?php

namespace App\Services;

use App\Models\AccessLink;
use Illuminate\Support\Str;

class AccessLinkGenerationService
{
    public function __construct(private AccessLinkDeactivationService $accessLinkDeactivationService)
    {
    }

    public function generate(int $userId): AccessLink
    {
        $this->accessLinkDeactivationService->deactivate($userId);

        $link = new AccessLink();

        $link->user_id = $userId;
        $link->token = Str::random(32);;

        $link->save();

        return $link;
    }
}
