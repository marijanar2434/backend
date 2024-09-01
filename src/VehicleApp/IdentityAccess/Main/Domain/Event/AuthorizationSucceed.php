<?php


namespace App\VehicleApp\IdentityAccess\Main\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;

class AuthorizationSucceed implements DomainEvent, PublishableDomainEvent, StorableDomainEvent
{
    use ImplementsDomainEvent;

    /**
     * @var mixed
     */
    private $attribute;

    /**
     * @var mixed
     */
    private $subject;

    /**
     * AuthorizationSucceed Constructor
     *
     * @param Id $entityId
     * @param mixed $attribute
     * @param mixed $subject
     */
    public function __construct(Id $entityId, $attribute, $subject)
    {
        $this->entityId = $entityId;
        $this->attribute = $attribute;
        $this->subject = $subject;
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return mixed $attribute
     */
    public function getAttribute(): mixed
    {
        return $this->attribute;
    }

    /**
     * @return mixed $subject
     */
    public function getSubject(): mixed
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return 'AuthorizationSucceed';
    }
}
