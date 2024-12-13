<?php

namespace App\Profile\Domain\Entities;

class Profile
{
    public function __construct(
        private string $email,
        private string $name,
        private string $avatarUrl
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }
}