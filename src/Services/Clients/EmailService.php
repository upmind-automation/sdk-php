<?php

declare(strict_types=1);

namespace Upmind\Sdk\Services\Clients;

use Upmind\Sdk\Data\ApiResponse;
use Upmind\Sdk\Data\QueryParams;
use Upmind\Sdk\Data\Services\CreateEmailParams;
use Upmind\Sdk\Data\Services\UpdateEmailParams;
use Upmind\Sdk\Services\AbstractService;

/**
 * Service for managing client emails.
 */
class EmailService extends AbstractService
{
    private const EMAILS_URI = '/api/admin/clients/{client_id}/emails';
    private const EMAIL_URI = '/api/admin/clients/{client_id}/emails/{email_id}';

    /**
     * Create a new email.
     */
    public function createEmail(string $clientId, CreateEmailParams $bodyParams): ApiResponse
    {
        return $this->api->post(
            $this->fillPathParams(self::EMAILS_URI, ['client_id' => $clientId]),
            $bodyParams
        );
    }

    /**
     * Update an existing email.
     */
    public function updateEmail(string $clientId, string $emailId, UpdateEmailParams $bodyParams): ApiResponse
    {
        return $this->api->put(
            $this->fillPathParams(self::EMAIL_URI, ['client_id' => $clientId, 'email_id' => $emailId]),
            $bodyParams
        );
    }

    /**
     * Get a list of emails for a client.
     */
    public function listEmails(string $clientId, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::EMAILS_URI, ['client_id' => $clientId]),
            $queryParams
        );
    }

    /**
     * Get a single email.
     */
    public function getEmail(string $clientId, string $emailId, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->api->get(
            $this->fillPathParams(self::EMAIL_URI, ['client_id' => $clientId, 'email_id' => $emailId]),
            $queryParams
        );
    }

    /**
     * Delete a client's email.
     */
    public function deleteEmail(string $clientId, string $emailId): ApiResponse
    {
        return $this->api->delete(
            $this->fillPathParams(self::EMAIL_URI, ['client_id' => $clientId, 'email_id' => $emailId]),
        );
    }
}
