<?php

namespace App\Profile\Domain\Interfaces;

interface ExternalProfileSourcesInterface
{
    public const FIRST_SOURCE = 'first';
    public const FIRST_SOURCE_URL = 'http://localhost:8001/api/mockProfile/source-one';
    public const SECOND_SOURCE = 'second';
    public const SECOND_SOURCE_URL = 'http://localhost:8001/api/mockProfile/source-two';
    public const THIRD_SOURCE = 'third';
    public const THIRD_SOURCE_URL = 'http://localhost:8001/api/mockProfile/source-three';

    public const SOURCE_TO_URL_MAP = [
        self::FIRST_SOURCE => self::FIRST_SOURCE_URL,
        self::SECOND_SOURCE => self::SECOND_SOURCE_URL,
        self::THIRD_SOURCE => self::THIRD_SOURCE_URL,
    ];
}