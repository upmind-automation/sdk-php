<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for updating an existing client company.
 */
class UpdateCompanyParams extends AbstractParams
{
    /**
     * @return static
     */
    public function setName(string $name): self
    {
        return $this->setParam('name', $name);
    }

    /**
     * Set the company tax/vat number.
     * 
     * @return static
     */
    public function setVatNumber(?string $vatNumber): self
    {
        return $this->setParam('vat_number', $vatNumber);
    }

    /**
     * Set the company/id/reg number.
     *
     * @return static
     */
    public function setRegistrationNumber(?string $regNumber): self
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
     * @return static
     */
    public function setAddressId(string $addressId): self
    {
        return $this->setParam('address_id', $addressId);
    }

    /**
     * @return static
     */
    public function setPhoneId(?string $phoneId): self
    {
        return $this->setParam('phone_id', $phoneId);
    }

    /**
     * @return static
     */
    public function setEmailId(?string $emailId): self
    {
        return $this->setParam('email_id', $emailId);
    }
}
