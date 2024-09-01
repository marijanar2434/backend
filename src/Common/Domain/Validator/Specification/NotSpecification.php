<?php

namespace App\Common\Domain\Validator\Specification;

class NotSpecification extends Specification
{
    /**
     * @var Specification
     */
    private $specification;

    /**
     * @param Specification $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    /**
     * @param mixed $object
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        return !$this->specification->isSatisfiedBy($object);
    }

    /**
     * @return Specification
     */
    public function specification(): Specification
    {
        return $this->specification;
    }
}
