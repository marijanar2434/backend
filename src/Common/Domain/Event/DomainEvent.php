<?php

namespace App\Common\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;

interface DomainEvent
{
    /**
     * @return Id|null
     */
    public function getEntityId(): ?Id;

    /**
     * @return int
     */
    public function getDomainEventVersion(): int;

    /**
     * @return string
     */
    public function getDomainEventType(): string;

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable;
}
