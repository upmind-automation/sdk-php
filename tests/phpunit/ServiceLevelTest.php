<?php

namespace Upmind\Sdk\Test;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Log\NullLogger;
use Upmind\Sdk\Api;
use Upmind\Sdk\Config;
use Upmind\Sdk\Data\Services\CreatePhoneParams;

class ServiceLevelTest extends TestCase
{
    private Api $api;

    /**
     * @var MockObject|ClientInterface
     */
    private MockObject $httpClient;

    private Config $config;

    protected function setUp(): void
    {
        $this->config = $this->getFakeConfig();
        $logger = new NullLogger();
        $this->httpClient = $this->getMockBuilder(ClientInterface::class)->getMock();

        $this->api = new Api($this->config, $logger, $this->httpClient);
    }

    public function testGetRequestSendsRequest(): void
    {
        // Prepare to capture the request body when it is sent to the client
        $requestBody = '';

        // A mock response for the client to return
        $mockResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();

        // Keep a record of the body of the request sent to the client. We will need to test the request body directly.
        $fakeDoRequest = function (RequestInterface  $request) use (&$requestBody, $mockResponse): ResponseInterface {
            $requestBody = $request->getBody()->getContents();
            return $mockResponse;
        };

        // Client should use our callback, which remembers the request body
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback($fakeDoRequest);

        // A phone number which should end up in the request body
        $bodyParams = new CreatePhoneParams();
        $bodyParams->setDiallingCode('+44');
        $bodyParams->setCountryCode('GB');
        $bodyParams->setPhoneNumber('0191 123 123 1');
        $bodyParams->setDefault(true);
        $bodyParams->setVerified(true);

        // Exercise object graph under test
        $this->api->sendRequest('POST', '/api/admin/clients/123/phones', $bodyParams);

        // The phone number should have ended up in the request body, as JSON
        $expectedRequestBody = '{"phone_code":"+44","phone_country_code":"GB","phone":"0191 123 123 1","default":true,"verified":1,"without_notifications":false}';
        $this->assertEquals($expectedRequestBody, $requestBody);
    }

    private function getFakeConfig(): Config
    {
        $configVals = [
            'hello-i-am-a-token',
            null,
            false,
            false,
            'api.upmind.io',
            'https',
            false
        ];

        return new Config(...$configVals);
    }
}
