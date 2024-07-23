<?php

declare(strict_types=1);

namespace Upmind\Sdk;

/**
 * Config settings for the Upmind API.
 */
class Config
{
    public function __construct(
        /** @var string $token Your Upmind API token */
        private string $token,
        /** @var string $brandId The default brand id to use for API requests */
        private ?string $brandId = null,
        /** @var bool $withoutNotifications Prevent create, update and delete requests from triggering notifications */
        private bool $withoutNotifications = false,
        /** @var bool $debug Whether or not to stream API requests + responses to STDERR by default */
        private bool $debug = false,
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

    public function isDebug(): bool
    {
        return $this->debug;
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
