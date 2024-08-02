<?php

declare(strict_types=1);

namespace Upmind\Sdk\Exceptions;

use Upmind\Sdk\Data\ApiResponse;

/**
 * Exception thrown for API validation (422) errors.
 *
 * @see \Upmind\Sdk\Config::restfulExceptions()
 */
class ValidationException extends ClientException
{
    public function __construct(ApiResponse $apiResponse, ?string $message = null)
    {
        $this->apiResponse = $apiResponse;
        $message = $message ?: $this->getValidationErrorMessage();
        parent::__construct($apiResponse, $message);
    }

    /**
     * @return array<string,string[]>
     */
    public function getValidationErrors(): array
    {
        return $this->getError()->getData();
    }

    protected function getValidationErrorMessage(): string
    {
        $messages = [];

        foreach ($this->getValidationErrors() as $field => $errors) {
            $messages[] = sprintf('%s: %s', $field, implode(', ', $errors));
        }

        return sprintf('Validation Error: %s', implode("; ", $messages));
    }
}
