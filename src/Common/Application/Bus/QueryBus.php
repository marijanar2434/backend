<?php

namespace App\Common\Application\Bus;

use App\Common\Application\Query\Query;
use App\Common\Application\Query\QueryResult;

interface QueryBus
{
    /**
     * @param Query $query
     *
     * @return QueryResult
     */
    public function handle($query): QueryResult;
}
