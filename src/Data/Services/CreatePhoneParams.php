<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for creating a new client phone.
 */
class CreatePhoneParams extends AbstractParams
{
    /**
     * Set the international dialling code e.g., +44.
     */
    public function setDiallingCode(string $phoneCode): self
    {
        return $this->setParam('phone_code', $phoneCode);
    }

    /**
     * Set the country code e.g., GB.
     */
    public function setCountryCode(string $countryCode): self
    {
        return $this->setParam('phone_country_code', $countryCode);
    }

    /**
     * Set the phone number without international dialling code e.g., 01234567890.
     */
    public function setPhoneNumber(string $number): self
    {
        return $this->setParam('phone', $number);
    }

    public function setDefault(bool $default): self
    {
        return $this->setParam('default', $default);
    }

    public function setVerified(bool $verified): self
    {
        return $this->setParam('verified', (int)$verified);
    }
}
