<?php

namespace App\Profile\Domain\Interfaces;

interface ExternalProfilePropertiesInterface
{
    public const PROPERTY_EMAIL = 'email';
    public const PROPERTY_NAME = 'name';
    public const PROPERTY_AVATAR_URL = 'avatar_url';

    public const PROPERTY_TO_SOURCE_WITH_PRIORITY = [
        self::PROPERTY_EMAIL => [
            ExternalProfileSourcesInterface::FIRST_SOURCE => 0,
        ],
        self::PROPERTY_NAME => [
            ExternalProfileSourcesInterface::FIRST_SOURCE => 2,
            ExternalProfileSourcesInterface::SECOND_SOURCE => 0,
            ExternalProfileSourcesInterface::THIRD_SOURCE => 1,
        ],
        self::PROPERTY_AVATAR_URL => [
            ExternalProfileSourcesInterface::THIRD_SOURCE => 0,
        ],
    ];
}