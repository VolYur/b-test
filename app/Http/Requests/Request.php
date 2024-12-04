<?php

namespace App\Http\Requests;

use App\Models\AccessLink;
use App\Models\User;
use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    public function getUserByToken(): ?User
    {
        $accessLink = AccessLink::query()->where('token', getallheaders()["token"] ?? '')->first();

        return User::query()->where('id', $accessLink->user_id)->first();
    }
}
