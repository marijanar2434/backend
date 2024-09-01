<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;

class RefreshTokenIssued implements DomainEvent, PublishableDomainEvent, StorableDomainEvent
{
    use ImplementsDomainEvent;

    /**
     * RefreshTokenIssued Constructor
     *
     * @param Id $entityId
     */
    public function __construct(Id $entityId)
    {
        $this->entityId = $entityId;
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return 'RefreshTokenIssued';
    }
}
