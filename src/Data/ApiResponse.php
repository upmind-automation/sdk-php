<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

use Psr\Http\Message\ResponseInterface;

class ApiResponse
{
    private ResponseInterface $psrResponse;
    private ?array $decodedBody = null;

    public function __construct(
        ResponseInterface $psrResponse
    ) {
        $this->psrResponse = $psrResponse;
        $this->decodedBody = json_decode($psrResponse->getBody()->getContents(), true);
    }

    /**
     * Determine whether the API response was successful.
     */
    public function isSuccessful(): bool
    {
        return $this->getHttpCode() >= 200 && $this->getHttpCode() < 300;
    }

    /**
     * Get the HTTP status code of the response.
     */
    public function getHttpCode(): int
    {
        return $this->psrResponse->getStatusCode();
    }

    /**
     * Get the API response status if a body is returned.
     */
    public function getResponseStatus(): ?ResponseStatus
    {
        return ResponseStatus::tryFrom($this->decodedBody['status'] ?? null);
    }

    /**
     * For paginated responses, the total indicates the total number of available
     * records. For group_count responses, the total is an associative array of
     * counts for each group.
     *
     * @return int|array|null
     */
    public function getResponseTotal()
    {
        if (!isset($this->decodedBody['total'])) {
            return null;
        }

        if (is_numeric($this->decodedBody['total'])) {
            return (int)$this->decodedBody['total'];
        }

        return $this->decodedBody['total'];
    }

    /**
     * Get the API response data as an associative array.
     */
    public function getResponseData(): ?array
    {
        return $this->decodedBody['data'] ?? null;
    }

    /**
     * Get the API response error details, if any.
     */
    public function getResponseError(): ?ApiError
    {
        if (empty($this->decodedBody['error'])) {
            return null;
        }

        return new ApiError($this->decodedBody['error']);
    }

    /**
     * Get the API response messages, if any.
     */
    public function getResponseMessages(): ?array
    {
        return $this->decodedBody['messages'] ?? null;
    }

    /**
     * Get the full response body as an associative array.
     */
    public function getDecodedBody(): ?array
    {
        return $this->decodedBody;
    }

    public function getPsr7Response(): ResponseInterface
    {
        return $this->psrResponse;
    }
}
