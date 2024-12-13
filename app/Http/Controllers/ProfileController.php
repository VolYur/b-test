<?php

namespace App\Http\Controllers;

use App\Profile\Domain\Clients\ProfileClient;
use App\Profile\Domain\Exceptions\ProfileNotFoundException;
use App\Profile\Domain\Repositories\ProfileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Log\Logger;

class ProfileController
{
    public function __construct(
        private ProfileRepository $profileRepository,
        private Logger $logger,
    ) {
    }

    public function __invoke(string $uuid): JsonResponse
    {
        try {
            $profile = $this->profileRepository->getOne($uuid);

            return new JsonResponse([
                "id" => $uuid,
                "email"=> $profile->getEmail(),
                "name" => $profile->getName(),
                "avatar_url" => $profile->getAvatarUrl(),
            ]);
        } catch (ProfileNotFoundException $exception) {
            return new JsonResponse('Profile not found', 404);
        } catch (\Throwable $exception) {echo $exception;
            $this->logger->error('', ['message' => $exception->getMessage(),]);
            return new JsonResponse('Something went wrong', 422);
        }
    }
}