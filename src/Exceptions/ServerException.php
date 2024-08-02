<?php

declare(strict_types=1);

namespace Upmind\Sdk\Exceptions;

/**
 * Exception thrown for API server (5xx) errors.
 *
 * @see \Upmind\Sdk\Config::restfulExceptions()
 */
class ServerException extends HttpException
{
    //
}
