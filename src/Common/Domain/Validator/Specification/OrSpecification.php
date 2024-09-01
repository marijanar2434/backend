<?php

namespace App\Common\Domain\Validator\Specification;

class OrSpecification extends Specification
{
    /**
     * @var Specification
     */
    private $one;

    /**
     * @var Specification
     */
    private $other;

    /**
     * @param Specification $one
     * @param Specification $other
     */
    public function __construct(Specification $one, Specification $other)
    {
        $this->one = $one;
        $this->other = $other;
    }

    /**
     * @inheritDoc
     */
    public function isSatisfiedBy($object): bool
    {
        return $this->one->isSatisfiedBy($object) || $this->other->isSatisfiedBy($object);
    }

    /**
     * @return Specification
     */
    public function one(): Specification
    {
        return $this->one;
    }

    /**
     * @return Specification
     */
    public function other(): Specification
    {
        return $this->other;
    }
}
