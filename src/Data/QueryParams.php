<?php

declare(strict_types=1);

namespace Upmind\Sdk\Data;

/**
 * Query parameters for GET requests.
 */
class QueryParams extends AbstractParams
{
    /**
     * Set number of records to return for paginated GET list requests.
     */
    public function setLimit(int $limit): self
    {
        return $this->setParam('limit', $limit);
    }

    /**
     * Set record offset for paginated GET list requests.
     */
    public function setOffset(int $offset): self
    {
        return $this->setParam('offset', $offset);
    }

    /**
     * Set sort order for GET list requests.
     *
     * @param string|array $orderBy
     */
    public function setOrderBy($orderBy): self
    {
        return $this->setParam('order_by', is_array($orderBy) ? implode(',', $orderBy) : $orderBy);
    }

    /**
     * Set related resources to include in responses for GET requests.
     *
     * @param string|array $with
     */
    public function setWith($with): self
    {
        return $this->setParam('with', is_array($with) ? implode(',', $with) : $with);
    }
}
