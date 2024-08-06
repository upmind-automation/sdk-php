<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

/**
 * Body parameters for POST/PUT/PATCH requests.
 */
class BodyParams extends AbstractParams
{
    public function toJson(int $jsonOptions = JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE): string
    {
        return json_encode($this, $jsonOptions);
    }
}
