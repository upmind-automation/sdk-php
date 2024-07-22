<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

/**
 * Error details for API error responses.
 */
class ApiError
{
    public function __construct(
        private array $data
    ) {
        //
    }

    /**
     * Get the error correlation ID.
     */
    public function getId(): string
    {
        return $this->data['id'];
    }

    /**
     * Get the error code.
     */
    public function getCode(): string
    {
        return (string)$this->data['code'];
    }

    /**
     * Get the error message.
     */
    public function getMessage(): string
    {
        return $this->data['message'];
    }

    /**
     * Get additional error data.
     */
    public function getData(): ?array
    {
        return $this->data['data'] ?? null;
    }
}
