<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\AccessLink;
use App\Models\User;
use App\Services\AccessLinkGenerationService;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;

class RegistrationController
{
    public function showRegistrationForm()
    {
        return view('registration.showRegistrationForm', [
            'linkToken' => session()->get('linkToken'),
        ]);
    }

    public function register(
        RegistrationRequest $registrationRequest,
        RegistrationService $registrationService
    ): RedirectResponse {
        $user = $registrationService->register(
            trim($registrationRequest->get('username')),
            trim($registrationRequest->get('phonenumber')),
        );

        return redirect('/')->with(['linkToken' => $user->accessLink->token]);
    }
}
