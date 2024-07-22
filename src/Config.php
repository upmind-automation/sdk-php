<?php

declare(strict_types=1);

namespace Upmind\Sdk;

/**
 * Config settings for the Upmind API.
 */
class Config
{
    public function __construct(
        private string $token,
        private ?string $brandId = null,
        private bool $withoutNotifications = false,
        private string $hostname = 'api.upmind.io',
        private string $protocol = 'https'
    ) {
        //
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getBrandId(): ?string
    {
        return $this->brandId;
    }

    public function isWithoutNotifications(): bool
    {
        return $this->withoutNotifications;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }
}
