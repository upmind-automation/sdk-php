<?php

declare(strict_types=1);

namespace Upmind\Sdk;

use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Upmind\Sdk\Config;
use Upmind\Sdk\Data\AbstractParams;
use Upmind\Sdk\Data\ApiResponse;
use Upmind\Sdk\Data\QueryParams;
use Upmind\Sdk\Logging\DefaultLogger;
use Upmind\Sdk\Services\Clients\AddressService;
use Upmind\Sdk\Services\Clients\ClientService;
use Upmind\Sdk\Services\Clients\CompanyService;
use Upmind\Sdk\Services\Clients\EmailService;
use Upmind\Sdk\Services\Clients\PhoneService;

/**
 * Upmind API SDK Client.
 */
class Api
{
    private Config $config;
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;

    public function __construct(
        Config $config,
        ?LoggerInterface $logger = null,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $defaultLogger = $config->isDebug() ? new DefaultLogger() : new NullLogger();

        $this->config = $config;
        $this->httpClient = (new PluginClientFactory())->createClient($httpClient, [
            new LoggerPlugin($logger ?? $defaultLogger, new FullHttpMessageFormatter(null))
        ]);
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * Service for managing clients (customers).
     */
    public function clientService(): ClientService
    {
        return new ClientService($this);
    }

    /**
     * Service for managing client addresses.
     */
    public function addressService(): AddressService
    {
        return new AddressService($this);
    }

    /**
     * Service for managing client phone numbers.
     */
    public function phoneService(): PhoneService
    {
        return new PhoneService($this);
    }

    /**
     * Service for managing client email addresses.
     */
    public function emailService(): EmailService
    {
        return new EmailService($this);
    }

    /**
     * Service for managing client companies.
     */
    public function companyService(): CompanyService
    {
        return new CompanyService($this);
    }

    /**
     * Send a GET request to the Upmind API.
     */
    public function get(string $uri, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->sendRequest('GET', $uri, null, $queryParams);
    }

    /**
     * Send a POST request to the Upmind API.
     */
    public function post(string $uri, AbstractParams $body = null, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->sendRequest('POST', $uri, $body, $queryParams);
    }

    /**
     * Send a PUT request to the Upmind API.
     */
    public function put(string $uri, AbstractParams $body = null, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->sendRequest('PUT', $uri, $body, $queryParams);
    }

    /**
     * Send a PATCH request to the Upmind API.
     */
    public function patch(string $uri, AbstractParams $body = null, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->sendRequest('PATCH', $uri, $body, $queryParams);
    }

    /**
     * Send a DELETE request to the Upmind API.
     */
    public function delete(string $uri, ?QueryParams $queryParams = null): ApiResponse
    {
        return $this->sendRequest('DELETE', $uri, null, $queryParams);
    }

    /**
     * Send a HTTP request to the Upmind API.
     */
    public function sendRequest(
        string $method,
        string $uri,
        ?AbstractParams $bodyParams = null,
        ?QueryParams $queryParams = null
    ): ApiResponse {
        $queryParams ??= new QueryParams();

        $this->fillDefaultParams($queryParams, $bodyParams);

        $url = sprintf(
            '%s://%s/%s',
            $this->config->getProtocol(),
            $this->config->getHostname(),
            $this->addQueryParams(ltrim($uri, '/'), $queryParams)
        );
        $request = $this->requestFactory->createRequest($method, $url)
            ->withHeader('User-Agent', $this->getUserAgent())
            ->withHeader('Authorization', 'Bearer ' . $this->config->getToken());

        if (!empty($bodyParams?->toArray())) {
            if (in_array(strtoupper($method), ['HEAD', 'GET', 'DELETE'])) {
                throw new \InvalidArgumentException('Request body is not allowed for this method');
            }

            $request = $request
                ->withHeader('Content-Type', 'application/json')
                ->withBody(
                    $this->streamFactory->createStream(
                        json_encode($bodyParams, JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE)
                    )
                );
        }

        return new ApiResponse($this->httpClient->sendRequest($request));
    }

    private function addQueryParams(string $uri, QueryParams $queryParams): string
    {
        $queryString = http_build_query($queryParams->toArray());

        if (empty($queryString)) {
            return $uri;
        }

        $join = str_contains($uri, '?') ? '&' : '?';

        return $uri . $join . $queryString;
    }

    private function fillDefaultParams(QueryParams $queryParams, ?AbstractParams $bodyParams = null): void
    {
        $fillParams = !empty($bodyParams?->toArray())
            ? $bodyParams
            : $queryParams;

        if ($brandId = $this->config->getBrandId()) {
            $fillParams->fillBrandId($brandId);
        }

        $fillParams->fillWithoutNotifications($this->config->isWithoutNotifications());
    }

    private function getUserAgent(): string
    {
        return sprintf(
            'Upmind-Sdk/%s PHP/%s',
            \Composer\InstalledVersions::getVersion('upmind/sdk') ?? 'dev',
            PHP_VERSION
        );
    }
}
