<?php

namespace App\Common\Domain\ValueObject;

use JsonSerializable;
use Ramsey\Uuid\Uuid;

class Id extends ValueObject implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
    }

    /**
     * @return  string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param ValueObject $object
     *
     * @return boolean
     */
    public function equals(ValueObject $object): bool
    {
        if ($object instanceof Id) {
            return $this->getId() === $object->getId();
        }

        return false;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->toString();
    }

    /**
     * @return boolean
     */
    public function isValid(): bool
    {
        return Uuid::isValid($this->id);
    }
}
