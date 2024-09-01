<?php

namespace App\Common\Application\Query;

use App\Common\Shared\Array\Arr;

class QueryResult
{
    /**
     * @var array
     */
    private $result;

    /**
     * @var int
     */
    private $total;

    /**
     * @param array $result
     * @param int $total
     */
    public function __construct(?array $result = [], int $total = 0)
    {
        $this->result = $result;
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
     * @return mixed
     */
    public function getFirst(): mixed
    {
        return Arr::first($this->result);
    }

    /**
     * @return  int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return empty($this->result);
    }
}
