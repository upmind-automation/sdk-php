<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

use DateTime;
use DateTimeInterface;
use JsonSerializable;

/**
 * Abstract parameter data.
 */
abstract class AbstractParams implements JsonSerializable
{
    final public function __construct(
        protected array $params = []
    ) {
        //
    }

    /**
     * Obtain a new instance.
     */
    public static function new(array $params = []): static
    {
        return new static($params);
    }

    /**
     * Set a parameter value.
     */
    public function setParam(string $param, mixed $value): static
    {
        $this->params[$param] = $value;

        return $this;
    }

    /**
     * Fill the brand id param without overwriting an existing value if set.
     */
    public function fillBrandId(string $brandId): static
    {
        return $this->fillParam('brand_id', $brandId);
    }

    /**
     * Fill the without_notifications param without overwriting an existing value if set.
     */
    public function fillWithoutNotifications(bool $withoutNotifications): static
    {
        return $this->fillParam('without_notifications', $withoutNotifications);
    }

    /**
     * Fill a parameter value without overwriting if the value is already set.
     */
    public function fillParam(string $param, mixed $value): static
    {
        if (!isset($this->params[$param])) {
            $this->setParam($param, $value);
        }

        return $this;
    }

    /**
     * Get all parameters as an associative array.
     */
    public function toArray(): array
    {
        return $this->params;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    protected function formatDateTime(DateTimeInterface $dateTime): string
    {
        return $dateTime()->format('Y-m-d H:i:s');
    }
}
