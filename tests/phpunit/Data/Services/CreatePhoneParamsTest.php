<?php

namespace Upmind\Sdk\Test\Data\Services;

use PHPUnit\Framework\TestCase;
use Upmind\Sdk\Data\Services\CreatePhoneParams;

class CreatePhoneParamsTest extends TestCase
{
    public function testJsonSerialization(): void
    {
        $sut = new CreatePhoneParams([]);
        $sut->setDiallingCode('+44');
        $sut->setCountryCode('GB');
        $sut->setPhoneNumber('0191 123 123 1');
        $sut->setDefault(true);
        $sut->setVerified(true);

        $json = json_encode($sut->jsonSerialize(), JSON_PRETTY_PRINT);

        $expectedResult = <<<JSON
{
    "phone_code": "+44",
    "phone_country_code": "GB",
    "phone": "0191 123 123 1",
    "default": true,
    "verified": 1
}
JSON;

        $this->assertEquals($expectedResult, $json);
    }
}
