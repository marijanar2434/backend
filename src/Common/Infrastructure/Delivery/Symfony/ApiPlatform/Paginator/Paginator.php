<?php

namespace App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator;

use ArrayIterator;
use ApiPlatform\Core\DataProvider\PaginatorInterface;

class Paginator implements PaginatorInterface, \IteratorAggregate
{
    /**
     * @var ArrayIterator
     */
    private $iterator;

    /**
     * @var array
     */
    private $data;

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
     * @param array $data
     * @param int $page
     * @param int $limit
     * @param int $total
     */
    public function __construct(array $data, int $page, int $limit, int $total)
    {
        $this->data = $data;
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
    }

    /**
     * @return float
     */
    public function getLastPage(): float
    {
        $ceil = ceil($this->getTotalItems() / $this->getItemsPerPage());

        if (empty($ceil)) {
            return 1.;
        }

        return $ceil;
    }

    /**
     * @return float
     */
    public function getTotalItems(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getCurrentPage(): float
    {
        return $this->page;
    }

    /**
     * @return float
     */
    public function getItemsPerPage(): float
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return (int)$this->getTotalItems();
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        if ($this->iterator === null) {
            $this->iterator = new ArrayIterator($this->data);
        }

        return $this->iterator;
    }
}
