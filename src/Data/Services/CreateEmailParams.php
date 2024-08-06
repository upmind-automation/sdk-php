<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;
use Upmind\Sdk\Data\BodyParams;

/**
 * Parameters for creating a new client email address.
 */
class CreateEmailParams extends BodyParams
{
    /**
     * @return static
     */
    public function setEmail(string $email): self
    {
        return $this->setParam('email', $email);
    }

    /**
     * Set this email address as the default one (used for sending notifications).
     *
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
