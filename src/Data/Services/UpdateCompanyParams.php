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
    public function setName(string $name): self
    {
        return $this->setParam('name', $name);
    }

    /**
     * Set the company tax/vat number.
     */
    public function setVatNumber(?string $vatNumber): self
    {
        return $this->setParam('vat_number', $vatNumber);
    }

    /**
     * Set the company/id/reg number.
     */
    public function setRegistrationNumber(?string $regNumber): self
    {
        return $this->setParam('reg_number', $regNumber);
    }

    public function setDefault(bool $default): self
    {
        return $this->setParam('default', $default);
    }

    public function setVerified(bool $verified): self
    {
        return $this->setParam('verified', (int)$verified);
    }

    public function setAddressId(string $addressId): self
    {
        return $this->setParam('address_id', $addressId);
    }

    public function setPhoneId(?string $phoneId): self
    {
        return $this->setParam('phone_id', $phoneId);
    }

    public function setEmailId(?string $emailId): self
    {
        return $this->setParam('email_id', $emailId);
    }
}
