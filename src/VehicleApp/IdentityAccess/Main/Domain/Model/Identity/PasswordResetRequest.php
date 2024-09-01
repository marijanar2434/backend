<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity;

use Ramsey\Uuid\Uuid;
use DateTimeImmutable;
use App\Common\Domain\ValueObject\ValueObject;
use JsonSerializable;

class PasswordResetRequest extends ValueObject implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $occurredOn;

    /**
     * PasswordResetRequest Constructor
     *
     * @param string|null $id
     */
    public function __construct($id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    /**
     * @param ValueObject $object
     * 
     * @return boolean
     */
    public function equals(ValueObject $object): bool
    {
        if ($object instanceof PasswordResetRequest) {
            return $this->getId() === $object->getId();
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return $this->getId();
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'occurredOn' => $this->occurredOn
        ];
    }
}
