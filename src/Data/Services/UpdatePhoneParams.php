<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for updating an existing client phone.
 */
class UpdatePhoneParams extends AbstractParams
{
    /**
     * Set the international dialling code e.g., +44.
     *
     * @return static
     */
    public function setDiallingCode(string $phoneCode): self
    {
        return $this->setParam('phone_code', $phoneCode);
    }

    /**
     * Set the country code e.g., GB.
     *
     * @return static
     */
    public function setCountryCode(string $countryCode): self
    {
        return $this->setParam('phone_country_code', $countryCode);
    }

    /**
     * Set the phone number without international dialling code e.g., 01234567890.
     *
     * @return static
     */
    public function setPhoneNumber(string $number): self
    {
        return $this->setParam('phone', $number);
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
