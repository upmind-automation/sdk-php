<?php

declare(strict_types=1);

namespace Upmind\Sdk\Services\Clients;

use Upmind\Sdk\Data\ApiResponse;
use Upmind\Sdk\Data\QueryParams;
use Upmind\Sdk\Exceptions\HttpException;
use Upmind\Sdk\Services\AbstractService;
use Upmind\Sdk\Data\Services\CreateClientParams;
use Upmind\Sdk\Data\Services\UpdateClientParams;

/**
 * Service for managing clients (customers).
 */
class ClientService extends AbstractService
{
    private const CLIENTS_URI = '/api/admin/clients';
    private const CLIENT_URI = '/api/admin/clients/{id}';

    /**
     * Create a new client.
     *
     * @throws HttpException if configured
     */
    public function createClient(CreateClientParams $bodyParams): ApiResponse
    {
        return $this->api->post(
            self::CLIENTS_URI,
            $bodyParams
        );
    }

    /**
     * Update an existing client.
     *
     * @throws HttpException if configured
     */
    public function updateClient(string $id, UpdateClientParams $bodyParams): ApiResponse
    {
        return $this->api->put(
            $this->fillPathParams(self::CLIENT_URI, ['id' => $id]),
            $bodyParams
        );
    }

    /**
     * Get a list of clients.
     *
     * @throws HttpException if configured
     */
    public function listClients(?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            self::CLIENTS_URI,
            $queryParams
        );
    }

    /**
     * Get a single client.
     *
     * @throws HttpException if configured
     */
    public function getClient(string $id, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::CLIENT_URI, ['id' => $id]),
            $queryParams
        );
    }

    /**
     * Delete a client.
     *
     * @throws HttpException if configured
     */
    public function deleteClient(string $id): ApiResponse
    {
        return $this->api->delete(
            $this->fillPathParams(self::CLIENT_URI, ['id' => $id]),
        );
    }
}
