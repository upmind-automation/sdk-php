<?php

declare(strict_types=1);

namespace Upmind\Sdk\Services;

abstract class AbstractService
{
    /**
     * Fill path parameters in the URI.
     *
     * @param string $uri E.g '/api/admin/clients/{id}'
     * @param array $pathParams E.g ['id' => 'abcdefg']
     *
     * @return string E.g '/api/admin/clients/abcdefg'
     */
    public function fillPathParams(string $uri, array $pathParams = []): string
    {
        foreach ($pathParams as $key => $value) {
            $uri = str_replace('{' . $key . '}', $value, $uri);
        }

        return $uri;
    }
}
