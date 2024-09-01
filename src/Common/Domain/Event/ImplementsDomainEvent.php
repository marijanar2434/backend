<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\ValueObject\Id;
use DateTimeImmutable;

trait ImplementsDomainEvent
{
    /**
     * @var Id
     */
    private $entityId;

    /**
     * @var int
     */
    private $domainEventVersion = 1;

    /**
     * @var DateTimeImmutable
     */
    private $occurredOn;

    /**
     * @return Id|null
     */
    public function getEntityId(): ?Id
    {
        return $this->entityId;
    }

    /**
     * @return int
     */
    public function getDomainEventVersion(): int
    {
        return $this->domainEventVersion;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
