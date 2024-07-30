<?php

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

    protected function setUp(): void
    {
        $config = new Config('hello-i-am-a-token');
        $logger = new NullLogger();
        $this->requestFactory = $this->getMockBuilder(RequestFactoryInterface::class)->getMock();

        $streamFactory = $this->getMockBuilder(StreamFactoryInterface::class)->getMock();

        $this->httpClient = $this->getMockBuilder(ClientInterface::class)->getMock();

        $this->sut = new Api($config, $logger, $this->httpClient, $this->requestFactory, $streamFactory);
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
}
