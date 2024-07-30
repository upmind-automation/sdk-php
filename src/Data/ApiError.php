<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

/**
 * Error details for API error responses.
 */
class ApiError
{
    private array $data;

    public function __construct(
        array $data
    ) {
        $this->data = $data;
    }

    /**
     * Get the error correlation ID.
     */
    public function getId(): string
    {
        return $this->data['id'];
    }

    /**
     * Get the error type, if any.
     */
    public function getType(): int
    {
        return (int)$this->data['type'];
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
