<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;
use Upmind\Sdk\Data\BodyParams;

/**
 * Parameters for creating a new client address.
 */
class CreateAddressParams extends BodyParams
{
    /**
     * @return static
     */
    public function setName(string $name): self
    {
        return $this->setParam('name', $name);
    }

    /**
     * @return static
     */
    public function setAddress1(string $address1): self
    {
        return $this->setParam('address_1', $address1);
    }

    /**
     * @return static
     */
    public function setAddress2(string $address2): self
    {
        return $this->setParam('address_2', $address2);
    }

    /**
     * @return static
     */
    public function setCity(string $city): self
    {
        return $this->setParam('city', $city);
    }

    /**
     * @return static
     */
    public function setPostCode(string $postCode): self
    {
        return $this->setParam('postcode', $postCode);
    }

    /**
     * @return static
     */
    public function setRegion(string $region): self
    {
        return $this->setParam('region', $region);
    }

    /**
     * @return static
     */
    public function setCountryCode(string $countryCode): self
    {
        return $this->setParam('country_code', $countryCode);
    }

    /**
     * @return static
     */
    public function setDefault(bool $default): self
    {
        return $this->setParam('default', $default);
    }

    /**
     * @return static
     */
    public function setVerified(bool $verified): self
    {
        return $this->setParam('verified', (int)$verified);
    }
}
