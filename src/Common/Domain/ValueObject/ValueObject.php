<?php

namespace App\Common\Domain\ValueObject;

use App\Common\Shared\InteractsWithConstants;

abstract class ValueObject
{
    use InteractsWithConstants;

    /**
     * @param ValueObject $object
     * 
     * @return boolean
     */
    public abstract function equals(ValueObject $object): bool;

    /**
     * @return string
     */
    public abstract function toString(): string;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
