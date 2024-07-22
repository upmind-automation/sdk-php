<?php

declare(strict_types=1);

namespace Upmind\Sdk\Services\Clients;

use Upmind\Sdk\Api;
use Upmind\Sdk\Data\ApiResponse;
use Upmind\Sdk\Data\QueryParams;
use Upmind\Sdk\Services\AbstractService;
use Upmind\Sdk\Data\Services\CreateClientParams;

/**
 * Service for managing clients (customers).
 */
class ClientService extends AbstractService
{
    private const CLIENTS_URI = '/api/admin/clients';
    private const CLIENT_URI = '/api/admin/clients/{id}';

    public function __construct(
        private Api $api
    ) {
        //
    }

    /**
     * Create a new client.
     */
    public function createClient(CreateClientParams $bodyParams): ApiResponse
    {
        return $this->api->post(
            self::CLIENTS_URI,
            $bodyParams
        );
    }

    /**
     * Get a list of clients.
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
     */
    public function deleteClient(string $id): ApiResponse
    {
        return $this->api->delete(
            $this->fillPathParams(self::CLIENT_URI, ['id' => $id]),
        );
    }
}
