<?php

declare(strict_types=1);

namespace Upmind\Sdk\Logging;

use Psr\Log\AbstractLogger;
use Stringable;

/**
 * Default logger which sends logs to a stream such as STDERR.
 */
class DefaultLogger extends AbstractLogger
{
    private $stream = STDERR;
    private bool $includeContext = false;
    private int $contextJsonOptions;

    /**
     * @param $stream  Resource to stream messages to
     * @param bool $includeContext  Whether or not to include context data in logs
     * @param int $contextJsonOptions  JSON options for serializing context data
     */
    public function __construct(
        $stream = STDERR,
        bool $includeContext = false,
        int $contextJsonOptions = JSON_PRETTY_PRINT | JSON_INVALID_UTF8_SUBSTITUTE
    ) {
        $this->stream = $stream;
        $this->includeContext = $includeContext;
        $this->contextJsonOptions = $contextJsonOptions;
    }

    public function log($level, $message, array $context = []): void
    {
        $context = $this->includeContext && !empty($context)
            ? json_encode($context, $this->contextJsonOptions)
            : null;

        fwrite(
            $this->stream,
            sprintf(
                "[%s] %s: %s\n",
                date('Y-m-d H:i:s'),
                strtoupper($level),
                implode("\n", array_filter([$message, $context]))
            )
        );
    }
}
