<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;

class AuthenticationAttempted implements DomainEvent, PublishableDomainEvent, StorableDomainEvent
{
    use ImplementsDomainEvent;

    /**
     * @var string
     */
    private $identity;

    /**
     * AuthenticationAttempted Constructor
     *
     * @param string $identity
     */
    public function __construct($identity)
    {
        $this->identity = $identity;
        $this->entityId = new Id();
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return string $identity
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return 'AuthenticationAttempted';
    }
}
