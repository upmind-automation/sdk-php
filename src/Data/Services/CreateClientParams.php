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
    /**
     * @return static
     */
    public function setFirstName(string $firstName): self
    {
        return $this->setParam('firstname', $firstName);
    }

    /**
     * @return static
     */
    public function setLastName(string $lastName): self
    {
        return $this->setParam('lastname', $lastName);
    }

    /**
     * @return static
     */
    public function setPublicName(string $publicName): self
    {
        return $this->setParam('public_name', $publicName);
    }

    /**
     * @return static
     */
    public function setUsername(string $username): self
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return $this->setParam('email', $username);
        }
        return $this->setParam('username', $username);
    }

    /**
     * @return static
     */
    public function setBrandId(string $brandId): self
    {
        return $this->setParam('brand_id', $brandId);
    }

    /**
     * @return static
     */
    public function setPassword(string $password): self
    {
        return $this->setParam('password', $password);
    }

    /**
     * @return static
     */
    public function setPasswordHash(string $passwordHash): self
    {
        return $this->setParam('password_hash', $passwordHash);
    }

    /**
     * @return static
     */
    public function setPricelistId(string $pricelistId): self
    {
        return $this->setParam('pricelist_id', $pricelistId);
    }

    /**
     * @return static
     */
    public function setHasLogin(bool $hasLogin): self
    {
        return $this->setParam('has_login', $hasLogin);
    }

    /**
     * @return static
     */
    public function setMeta(array $meta): self
    {
        return $this->setParam('meta', $meta);
    }

    /**
     * @return static
     */
    public function setLanguageCode(string $languageCode): self
    {
        return $this->setParam('language_code', $languageCode);
    }

    /**
     * @return static
     */
    public function setCurrencyCode(string $currencyCode): self
    {
        return $this->setParam('currency_code', $currencyCode);
    }

    /**
     * @return static
     */
    /**
     * @param array<string,mixed> $customFieldValues
     */
    public function setCustomFieldValues(array $customFieldValues): self
    {
        return $this->setParam('custom_field_values', $customFieldValues);
    }

    /**
     * @return static
     */
    public function setVerified(bool $verified): self
    {
        return $this->setParam('verified', $verified);
    }

    /**
     * @return static
     */
    public function setSupportPin(string $supportPin): self
    {
        return $this->setParam('support_pin', $supportPin);
    }

    /**
     * @return static
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        return $this->setParam('created_at', $this->formatDateTime($createdAt));
    }
}
