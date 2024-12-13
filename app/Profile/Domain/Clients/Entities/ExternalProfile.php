<?php

namespace App\Profile\Domain\Clients\Entities;

class ExternalProfile
{
    public function __construct(
        private string $source,
        private ?string $email,
        private ?string $name,
        private ?string $avatarUrl
    ) {
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }
}