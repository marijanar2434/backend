<?php

namespace App\Common\Application\Query;

abstract class CollectionQuery extends Query
{
    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var array
     */
    protected $filter;

    /**
     * @var array
     */
    protected $order;

    /**
     * @param int $page
     * @param int $limit
     * @param array $filter
     * @param array $order
     */
    public function __construct($page = 1, $limit = 10, $filter = [], $order = [])
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->filter = $filter;
        $this->order = $order;
    }

    /**
     * @return  int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return  int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return  array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }

    /**
     * @return  array
     */
    public function getOrder(): array
    {
        return $this->order;
    }
}
