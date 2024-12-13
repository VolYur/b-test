<?php

namespace App\Profile\Domain\Repositories;

use App\Profile\Domain\Builders\ProfileFromExternalProfilesBuilder;
use App\Profile\Domain\Clients\ProfileClient;
use App\Profile\Domain\Entities\Profile;
use App\Profile\Domain\Exceptions\ProfileNotFoundException;

class ProfileRepository
{
    public function __construct(
        private ProfileClient $profileClient,
        private ProfileFromExternalProfilesBuilder $profileFromExternalProfilesBuilder,
    ) {
    }

    /**
     * @param string $uuid
     * @return Profile
     *
     * @throw ProfileNotFoundException
     */
    public function getOne(string $uuid): Profile
    {
       $externalProfiles = $this->profileClient->getProfilesBySource($uuid);

        if (empty($externalProfiles)) {
            throw new ProfileNotFoundException();
        }

        return $this->profileFromExternalProfilesBuilder->build(... $externalProfiles);
    }
}