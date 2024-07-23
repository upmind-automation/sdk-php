<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for updating an existing client.
 */
class UpdateClientParams extends AbstractParams
{
    public function setFirstName(string $firstName): static
    {
        return $this->setParam('firstname', $firstName);
    }

    public function setLastName(string $lastName): static
    {
        return $this->setParam('lastname', $lastName);
    }

    public function setPublicName(string $publicName): static
    {
        return $this->setParam('public_name', $publicName);
    }

    public function setUsername(string $username): static
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return $this->setParam('email', $username);
        }
        return $this->setParam('username', $username);
    }

    public function setPassword(string $password): static
    {
        return $this->setParam('password', $password);
    }

    public function setPricelistId(string $pricelistId): static
    {
        return $this->setParam('pricelist_id', $pricelistId);
    }

    public function setHasLogin(bool $hasLogin): static
    {
        return $this->setParam('has_login', $hasLogin);
    }

    public function setMeta(array $meta): static
    {
        return $this->setParam('meta', $meta);
    }

    public function setLanguageCode(string $languageCode): static
    {
        return $this->setParam('language_code', $languageCode);
    }

    public function setCurrencyCode(string $currencyCode): static
    {
        return $this->setParam('currency_code', $currencyCode);
    }

    /**
     * @param array<string,mixed> $customFieldValues
     */
    public function setCustomFieldValues(array $customFieldValues): static
    {
        return $this->setParam('custom_field_values', $customFieldValues);
    }

    public function setVerified(bool $verified): static
    {
        return $this->setParam('verified', $verified);
    }

    public function setSupportPin(string $supportPin): static
    {
        return $this->setParam('support_pin', $supportPin);
    }

    public function setCreatedAt(DateTimeInterface $createdAt): static
    {
        return $this->setParam('created_at', $this->formatDateTime($createdAt));
    }
}
