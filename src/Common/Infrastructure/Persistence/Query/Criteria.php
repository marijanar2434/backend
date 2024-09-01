<?php

namespace App\Common\Infrastructure\Persistence\Query;

class Criteria
{
    /**
     * @var array 
     */
    public $filters = [];

    /**
     * @var int 
     */
    public $page = 1;

    /**
     * @var int 
     */
    public $limit = 10;

    /**
     * @var array 
     */
    public $order = [];

    /**
     * @param array $filters
     * @param int $page
     * @param int $limit
     * @param array $order
     * 
     * @return Criteria
     */
    public function __construct(array $filters = [], int $page = 1, int $limit = 10, array $order = [])
    {
        $this->filters = $filters;
        $this->page = $page;
        $this->limit = $limit;
        $this->order = $order;
    }

    /**
     * @return  array
     */
    public function getFilters(): array
    {
        return $this->filters;
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
    public function getOrder(): array
    {
        return $this->order;
    }
}
