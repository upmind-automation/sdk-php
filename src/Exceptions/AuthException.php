<?php

declare(strict_types=1);

namespace Upmind\Sdk\Exceptions;

use Upmind\Sdk\Data\ApiResponse;

/**
 * Exception thrown for API authentication (401) errors.
 *
 * @see \Upmind\Sdk\Config::restfulExceptions()
 */
class AuthException extends ClientException
{
    public function __construct(ApiResponse $apiResponse, ?string $message = null)
    {
        $this->apiResponse = $apiResponse;
        $message = $message ?: $this->getHint();
        parent::__construct($apiResponse, $message);
    }

    /**
     * Hint for solving the issue.
     */
    protected function getHint(): ?string
    {
        return $this->getResponse()->getResponseMessages()['hint'] ?? null;
    }
}
