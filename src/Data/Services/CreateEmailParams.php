<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data\Services;

use DateTimeInterface;
use Upmind\Sdk\Data\AbstractParams;

/**
 * Parameters for creating a new client email address.
 */
class CreateEmailParams extends AbstractParams
{
    public function setEmail(string $email): self
    {
        return $this->setParam('email', $email);
    }

    /**
     * Set this email address as the default one (used for sending notifications).
     */
    public function setDefault(bool $default): self
    {
        return $this->setParam('default', $default);
    }

    public function setVerified(bool $verified): self
    {
        return $this->setParam('verified', (int)$verified);
    }
}
