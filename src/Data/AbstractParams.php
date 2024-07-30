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
    protected array $params = [];

    final public function __construct(
        array $params = []
    ) {
        $this->params = $params;
    }

    /**
     * Obtain a new instance.
     */
    public static function new(array $params = []): self
    {
        return new static($params);
    }

    /**
     * Set a parameter value.
     */
    public function setParam(string $param, $value): self
    {
        $this->params[$param] = $value;

        return $this;
    }

    /**
     * Fill the brand id param without overwriting an existing value if set.
     */
    public function fillBrandId(string $brandId): self
    {
        return $this->fillParam('brand_id', $brandId);
    }

    /**
     * Fill the without_notifications param without overwriting an existing value if set.
     */
    public function fillWithoutNotifications(bool $withoutNotifications): self
    {
        return $this->fillParam('without_notifications', $withoutNotifications);
    }

    /**
     * Fill a parameter value without overwriting if the value is already set.
     */
    public function fillParam(string $param, $value): self
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

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    protected function formatDateTime(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('Y-m-d H:i:s');
    }
}
