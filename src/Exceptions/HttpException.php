<?php

declare(strict_types=1);

namespace Upmind\Sdk\Exceptions;

use Upmind\Sdk\Data\ApiError;
use Upmind\Sdk\Data\ApiResponse;

/**
 * Exception thrown for API error responses.
 *
 * @see \Upmind\Sdk\Config::restfulExceptions()
 */
class HttpException extends \Exception implements UpmindSdkException
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse, ?string $message = null)
    {
        $this->apiResponse = $apiResponse;
        $message = $message ?: $this->getApiError()->getMessage();
        parent::__construct($message, $this->getHttpCode());
    }

    public function getHttpCode(): int
    {
        return $this->apiResponse->getHttpCode();
    }

    public function getApiResponse(): ApiResponse
    {
        return $this->apiResponse;
    }

    public function getApiError(): ApiError
    {
        return $this->apiResponse->getResponseError();
    }
}
