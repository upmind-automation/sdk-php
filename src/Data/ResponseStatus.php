<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

/**
 * Status returned when API responses have a body.
 */
enum ResponseStatus: string
{
    case OK = 'ok';
    case ERROR = 'error';
}
