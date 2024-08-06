<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;
use Upmind\Sdk\Data\BodyParams;

/**
 * Parameters for creating a new client companies.
 */
class CreateCompanyParams extends BodyParams
{
    public function setName(string $name): self
    {
        return $this->setParam('name', $name);
    }

    /**
     * Set the company tax/vat number.
     *
     * @return static
     */
    public function setVatNumber(string $vatNumber): self
    {
        return $this->setParam('vat_number', $vatNumber);
    }

    /**
     * Set the company/id/reg number.
     *
     * @return static
     */
    public function setRegistrationNumber(string $regNumber): self
    {
        return $this->setParam('reg_number', $regNumber);
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

    /**
     * Use an existing address.
     *
     * @return static
     */
    public function setAddressId(string $addressId): self
    {
        return $this->setParam('address_id', $addressId);
    }

    /**
     * Create a new address.
     *
     * @return static
     */
    public function setAddressParams(CreateAddressParams $addressParams): self
    {
        return $this->setParam('address', $addressParams->toArray());
    }

    /**
     * Use an existing phone number.
     *
     * @return static
     */
    public function setPhoneId(string $phoneId): self
    {
        return $this->setParam('phone_id', $phoneId);
    }

    /**
     * Create a new phone number.
     *
     * @return static
     */
    public function setPhoneParams(CreatePhoneParams $phoneParams): self
    {
        return $this->setParam('phone', $phoneParams->toArray());
    }

    /**
     * Use an existing email address.
     *
     * @return static
     */
    public function setEmailId(string $emailId): self
    {
        return $this->setParam('email_id', $emailId);
    }

    /**
     * Create a new email address.
     *
     * @return static
     */
    public function setEmailParams(CreateEmailParams $emailParams): self
    {
        return $this->setParam('email', $emailParams->toArray());
    }
}
