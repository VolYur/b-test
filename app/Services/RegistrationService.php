<?php

namespace App\Services;

use App\Models\User;

class RegistrationService
{
    public function __construct(
        private AccessLinkGenerationService $accessLinkGenerationService
    ){
    }

    public function register(string $username, string $phonenumber): User
    {
        $user = new User();

        $user->username = $username;
        $user->phonenumber = $phonenumber;

        $user->save();

        $this->accessLinkGenerationService->generate($user->id);

        return $user;
    }
}
