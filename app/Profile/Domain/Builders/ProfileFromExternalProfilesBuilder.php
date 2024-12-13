<?php

namespace App\Profile\Domain\Builders;

use App\Profile\Domain\Clients\Entities\ExternalProfile;
use App\Profile\Domain\Entities\Profile;
use App\Profile\Domain\Interfaces\ExternalProfilePropertiesInterface as Prop;

class ProfileFromExternalProfilesBuilder
{
    public function build(ExternalProfile ...$externalProfiles): Profile
    {
        return new Profile(
            $this->resolvePropertyValueViaPriority(Prop::PROPERTY_EMAIL, 'getEmail', ...$externalProfiles) ?? '',
            $this->resolvePropertyValueViaPriority(Prop::PROPERTY_NAME, 'getName', ...$externalProfiles) ?? '',
            $this->resolvePropertyValueViaPriority(Prop::PROPERTY_AVATAR_URL, 'getAvatarUrl', ...$externalProfiles) ?? '',
        );
    }

    private function resolvePropertyValueViaPriority(string $propertyName, string $getterName, ExternalProfile ...$externalProfiles, ): mixed
    {
        $value = null;

        $prevPriority = null;
        /** @var ExternalProfile $externalProfile */
        foreach ($externalProfiles as $externalProfile) {
            $priority
                = Prop::PROPERTY_TO_SOURCE_WITH_PRIORITY[$propertyName][$externalProfile->getSource()] ?? null;

            if (
                is_numeric($priority)
                && (null === $prevPriority || $priority < $prevPriority)
            ) {
                $prevPriority = $priority;
                $value = $externalProfile->{$getterName}();
            }
        }

        return $value;
    }
}