<?php

declare(strict_types=1);

namespace Upmind\Sdk;

/**
 * Config settings for the Upmind API.
 */
class Config
{
    private string $token;
    private ?string $brandId;
    private bool $withoutNotifications;
    private bool $debug;
    private string $hostname;
    private string $protocol;
    private bool $restfulExceptions;

    /**
     * @param string $token  Your Upmind API token
     * @param string|null $brandId  The default brand id to use for API requests
     * @param bool $withoutNotifications  Prevent create, update and delete requests from triggering notifications
     * @param bool $debug Whether or not to stream API requests + responses to STDERR by default
     * @param string $hostname
     * @param string $protocol
     * @param bool $restfulExceptions
     */
    public function __construct(
        string $token,
        ?string $brandId = null,
        bool $withoutNotifications = false,
        bool $debug = false,
        string $hostname = 'api.upmind.io',
        string $protocol = 'https',
        bool $restfulExceptions = false
    ) {
        $this->token = $token;
        $this->brandId = $brandId;
        $this->withoutNotifications = $withoutNotifications;
        $this->debug = $debug;
        $this->hostname = $hostname;
        $this->protocol = $protocol;
        $this->restfulExceptions = $restfulExceptions;
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

    public function restfulExceptions(): bool
    {
        return $this->restfulExceptions;
    }
}
