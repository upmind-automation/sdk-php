<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for creating a new client.
 */
class CreateClientParams extends AbstractParams
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

    public function setEmail(string $email): static
    {
        return $this->setParam('email', $email);
    }

    public function setUsername(string $username): static
    {
        return $this->setParam('username', $username);
    }

    public function setBrandId(string $brandId): static
    {
        return $this->setParam('brand_id', $brandId);
    }

    public function setPassword(string $password): static
    {
        return $this->setParam('password', $password);
    }

    public function setPasswordHash(string $passwordHash): static
    {
        return $this->setParam('password_hash', $passwordHash);
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
