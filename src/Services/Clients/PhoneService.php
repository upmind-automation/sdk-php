<?php

declare(strict_types=1);

namespace Upmind\Sdk\Services\Clients;

use Upmind\Sdk\Data\ApiResponse;
use Upmind\Sdk\Data\QueryParams;
use Upmind\Sdk\Data\Services\CreatePhoneParams;
use Upmind\Sdk\Data\Services\UpdatePhoneParams;
use Upmind\Sdk\Exceptions\HttpException;
use Upmind\Sdk\Services\AbstractService;

/**
 * Service for managing client phones.
 */
class PhoneService extends AbstractService
{
    private const PHONES_URI = '/api/admin/clients/{client_id}/phones';
    private const PHONE_URI = '/api/admin/clients/{client_id}/phones/{phone_id}';

    /**
     * Create a new phone.
     *
     * @throws HttpException if configured
     */
    public function createPhone(string $clientId, CreatePhoneParams $bodyParams): ApiResponse
    {
        return $this->api->post(
            $this->fillPathParams(self::PHONES_URI, ['client_id' => $clientId]),
            $bodyParams
        );
    }

    /**
     * Update an existing phone.
     *
     * @throws HttpException if configured
     */
    public function updatePhone(string $clientId, string $phoneId, UpdatePhoneParams $bodyParams): ApiResponse
    {
        return $this->api->put(
            $this->fillPathParams(self::PHONE_URI, ['client_id' => $clientId, 'phone_id' => $phoneId]),
            $bodyParams
        );
    }

    /**
     * Get a list of phones for a client.
     *
     * @throws HttpException if configured
     */
    public function listPhones(string $clientId, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::PHONES_URI, ['client_id' => $clientId]),
            $queryParams
        );
    }

    /**
     * Get a single phone.
     *
     * @throws HttpException if configured
     */
    public function getPhone(string $clientId, string $phoneId, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::PHONE_URI, ['client_id' => $clientId, 'phone_id' => $phoneId]),
            $queryParams
        );
    }

    /**
     * Delete a client's phone.
     *
     * @throws HttpException if configured
     */
    public function deletePhone(string $clientId, string $phoneId): ApiResponse
    {
        return $this->api->delete(
            $this->fillPathParams(self::PHONE_URI, ['client_id' => $clientId, 'phone_id' => $phoneId]),
        );
    }
}
