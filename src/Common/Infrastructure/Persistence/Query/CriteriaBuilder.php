<?php

namespace App\Common\Infrastructure\Persistence\Query;

use App\Common\Infrastructure\Persistence\Query\Criteria;

interface CriteriaBuilder
{
    /**
     * @param Criteria $criteria
     * @param string|null $alias
     * 
     * @return mixed
     */
    public function build(Criteria $criteria, ?string $alias): mixed;
}
