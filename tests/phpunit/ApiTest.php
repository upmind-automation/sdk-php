<?php

namespace Upmind\Sdk\Test;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\NullLogger;
use Upmind\Sdk\Api;
use Upmind\Sdk\Config;
use Upmind\Sdk\Data\QueryParams;

class ApiTest extends TestCase
{
    private Api $sut;

    /**
     * @var MockObject|ClientInterface
     */
    private MockObject $httpClient;

    /**
     * @var MockObject|RequestFactoryInterface
     */
    private MockObject $requestFactory;

    private Config $config;

    protected function setUp(): void
    {
        $this->config = $this->getFakeConfig();
        $logger = new NullLogger();
        $this->requestFactory = $this->getMockBuilder(RequestFactoryInterface::class)->getMock();
        $streamFactory = $this->getMockBuilder(StreamFactoryInterface::class)->getMock();
        $this->httpClient = $this->getMockBuilder(ClientInterface::class)->getMock();

        $this->sut = new Api($this->config, $logger, $this->httpClient, $this->requestFactory, $streamFactory);
    }

    public function testGetRequestSendsRequest(): void
    {
        // Request will be created
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $this->requestFactory->expects($this->once())->method('createRequest')->willReturn($request);

        // Request headers will be set
        $request->expects($this->atLeastOnce())->method('withHeader')->willReturn($request);

        // HTTP client will return a response
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $this->httpClient->expects($this->once())->method('sendRequest')->with($request)->willReturn($response);

        // Excercise subject under test
        $this->sut->get('/target/uri');
    }

    public function testQueryParamHandling(): void
    {
        // In this test, set a query param
        $queryParams = new QueryParams(['with' => 'something']);

        // Request will be created
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();

        // The request should have a URI with our query param
        $this->requestFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with('GET', 'https://api.upmind.io/target/uri?with=something&without_notifications=0')
            ->willReturn($request);

        // Other misc. setup
        $this->requestHeadersWillBeSent($request);
        $this->httpClientWillReturnResponse($request);

        // Exercise subject under test
        $this->sut->get('/target/uri', $queryParams);
    }

    public function testBrandIdFromConfigUsed(): void
    {
        $this->config->overrideBrandId('123');

        // Request will be created
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();

        // The request should have a URI the new brand ID
        $this->requestFactory
            ->expects($spy = $this->any())
            ->method('createRequest')
            ->with('GET', 'https://api.upmind.io/target/uri?brand_id=123&without_notifications=0')
            ->willReturn($request);

        // Other misc. setup
        $this->requestHeadersWillBeSent($request);
        $this->httpClientWillReturnResponse($request);

        // Exercise subject under test
        $this->sut->get('/target/uri');
    }

    public function testBrandIdFromConfigOverridable(): void
    {
        $this->config->overrideBrandId('123');

        // In this test, set an override of the above default Brand ID in the query param
        $queryParams = new QueryParams(['brand_id' => '456']);

        // Request will be created
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();

        // The request should have a URI the override brand ID
        $this->requestFactory
            ->expects($spy = $this->any())
            ->method('createRequest')
            ->with('GET', 'https://api.upmind.io/target/uri?brand_id=456&without_notifications=0')
            ->willReturn($request);

        // Other misc. setup
        $this->requestHeadersWillBeSent($request);
        $this->httpClientWillReturnResponse($request);

        // Exercise subject under test
        $this->sut->get('/target/uri', $queryParams);
    }

    private function requestHeadersWillBeSent(MockObject $request): void
    {
        $request->expects($this->atLeastOnce())->method('withHeader')->willReturn($request);
    }

    private function httpClientWillReturnResponse(MockObject $request)
    {
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $this->httpClient->expects($this->once())->method('sendRequest')->with($request)->willReturn($response);
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

        return new class(...$configVals) extends Config {
            private ?string $overrideBrandId = null;
            public function overrideBrandId(string $brandId): void
            {
                $this->overrideBrandId = $brandId;
            }
            public function getBrandId(): ?string
            {
                return $this->overrideBrandId;
            }
        };
    }
}
