<?php

namespace Upmind\Sdk\Test\Services\Clients;

use PHPUnit\Framework\TestCase;
use Upmind\Sdk\Api;
use Upmind\Sdk\Data\Services\CreatePhoneParams;
use Upmind\Sdk\Services\Clients\PhoneService;

class PhoneServiceTest extends TestCase
{
    public function testCreatePhoneUsesBodyParamsCorrectly(): void
    {
        $api = $this->getMockBuilder(Api::class)->disableOriginalConstructor()->getMock();

        $createPhoneParams = new CreatePhoneParams();

        $api->expects($this->once())
            ->method('post')
            ->with('/api/admin/clients/123/phones', $createPhoneParams);

        $sut = new PhoneService($api);

        $sut->createPhone('123', $createPhoneParams);
    }
}
