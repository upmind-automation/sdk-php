<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for creating a new client address.
 */
class CreateAddressParams extends AbstractParams
{
    public function setName(string $name): self
    {
        return $this->setParam('name', $name);
    }

    public function setAddress1(string $address1): self
    {
        return $this->setParam('address_1', $address1);
    }

    public function setAddress2(string $address2): self
    {
        return $this->setParam('address_2', $address2);
    }

    public function setCity(string $city): self
    {
        return $this->setParam('city', $city);
    }

    public function setPostCode(string $postCode): self
    {
        return $this->setParam('postcode', $postCode);
    }

    public function setRegion(string $region): self
    {
        return $this->setParam('region', $region);
    }

    public function setCountryCode(string $countryCode): self
    {
        return $this->setParam('country_code', $countryCode);
    }

    public function setDefault(bool $default): self
    {
        return $this->setParam('default', $default);
    }

    public function setVerified(bool $verified): self
    {
        return $this->setParam('verified', $verified);
    }
}
