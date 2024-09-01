<?php

namespace App\Common\Domain;

use App\Common\Domain\ValueObject\Id;

abstract class Entity
{
    use Identity;

    /**
     * Entity Constructor
     *
     * @param Id $id
     */
    public function __construct(Id $id)
    {
        $this->setId($id);
    }
}
