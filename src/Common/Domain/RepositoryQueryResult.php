<?php

namespace App\Common\Domain;

class RepositoryQueryResult
{
    /**
     * @var array
     */
    private $result;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $total;

    /**
     * @param array $result
     * @param int $page
     * @param int $limit
     * @param int $total
     */
    public function __construct(array $result, int  $page, int  $limit, int $total)
    {
        $this->result = $result;
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
    }

    /**
     * @return  array
     */
    public function getResult(): array
    {
        return $this->result;
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
     * @return  int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
