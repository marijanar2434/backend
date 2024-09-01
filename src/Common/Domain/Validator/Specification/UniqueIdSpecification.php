<?php

namespace App\Common\Domain\Validator\Specification;

use App\Common\Domain\Entity;
use App\Common\Domain\Repository;
use App\Common\Domain\Validator\Specification\Specification;

class UniqueIdSpecification extends Specification
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * UniqueIdSpecification Constructor
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Entity $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $entity = $this->repository->findById(
            $object->getId()
        );

        return $entity === null || $entity === $object;
    }
}
