<?php

declare(strict_types=1);

namespace Upmind\Sdk\Services\Clients;

use Upmind\Sdk\Data\ApiResponse;
use Upmind\Sdk\Data\QueryParams;
use Upmind\Sdk\Data\Services\CreateAddressParams;
use Upmind\Sdk\Data\Services\UpdateAddressParams;
use Upmind\Sdk\Exceptions\HttpException;
use Upmind\Sdk\Services\AbstractService;

/**
 * Service for managing client addresses.
 */
class AddressService extends AbstractService
{
    private const ADDRESSES_URI = '/api/admin/clients/{client_id}/addresses';
    private const ADDRESS_URI = '/api/admin/clients/{client_id}/addresses/{address_id}';

    /**
     * Create a new address.
     *
     * @throws HttpException if configured
     */
    public function createAddress(string $clientId, CreateAddressParams $bodyParams): ApiResponse
    {
        return $this->api->post(
            $this->fillPathParams(self::ADDRESSES_URI, ['client_id' => $clientId]),
            $bodyParams
        );
    }

    /**
     * Update an existing address.
     *
     * @throws HttpException if configured
     */
    public function updateAddress(string $clientId, string $addressId, UpdateAddressParams $bodyParams): ApiResponse
    {
        return $this->api->put(
            $this->fillPathParams(self::ADDRESS_URI, ['client_id' => $clientId, 'address_id' => $addressId]),
            $bodyParams
        );
    }

    /**
     * Get a list of addresses for a client.
     *
     * @throws HttpException if configured
     */
    public function listAddresses(string $clientId, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::ADDRESSES_URI, ['client_id' => $clientId]),
            $queryParams
        );
    }

    /**
     * Get a single address.
     *
     * @throws HttpException if configured
     */
    public function getAddress(string $clientId, string $addressId, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::ADDRESS_URI, ['client_id' => $clientId, 'address_id' => $addressId]),
            $queryParams
        );
    }

    /**
     * Delete a client's address.
     *
     * @throws HttpException if configured
     */
    public function deleteAddress(string $clientId, string $addressId): ApiResponse
    {
        return $this->api->delete(
            $this->fillPathParams(self::ADDRESS_URI, ['client_id' => $clientId, 'address_id' => $addressId]),
        );
    }
}
