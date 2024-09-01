<?php

namespace App\Common\Domain\Validator\Specification;

abstract class Specification
{
    /**
     * @param mixed $object
     * 
     * @return boolean
     */
    abstract public function isSatisfiedBy($object): bool;

    /**
     * @param Specification $specification
     * 
     * @return AndSpecification
     */
    public function and(Specification $specification): AndSpecification
    {
        return new AndSpecification($this, $specification);
    }

    /**
     * @param Specification $specification
     * 
     * @return OrSpecification
     */
    public function or(Specification $specification): OrSpecification
    {
        return new OrSpecification($this, $specification);
    }

    /**
     * @return NotSpecification
     */
    public function not(): NotSpecification
    {
        return new NotSpecification($this);
    }
}
