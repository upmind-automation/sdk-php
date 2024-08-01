<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

/**
 * Status returned when API responses have a body.
 */
class ResponseStatus
{
    public const OK = 'OK';

    public const ERROR = 'ERROR';

    private const VALID_VALUES = [
        self::OK,
        self::ERROR,
    ];

    private string $value;

    private function __construct(string $value)
    {
        if (!in_array($value, self::VALID_VALUES, true)) {
            throw new \InvalidArgumentException('Not a valid value');
        }
        $this->value = $value;
    }

    public static function tryFrom(?string $value): ?self
    {
        try {
            return new self($value);
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
