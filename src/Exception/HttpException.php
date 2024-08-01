<?php

declare(strict_types=1);

namespace Upmind\Sdk\Exception;

use Psr\Http\Message\ResponseInterface;
use Upmind\Sdk\Data\ApiError;

class HttpException extends \Exception
{
    private ResponseInterface $response;

    private ApiError $apiError;

    public function __construct(ResponseInterface $response, ApiError $apiError)
    {
        parent::__construct($response->getReasonPhrase(), $response->getStatusCode());
        $this->response = $response;
        $this->apiError = $apiError;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getError(): ApiError
    {
        return $this->apiError;
    }
}
