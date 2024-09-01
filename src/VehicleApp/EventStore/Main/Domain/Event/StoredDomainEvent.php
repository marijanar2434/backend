<?php

namespace App\VehicleApp\EventStore\Main\Domain\Event;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

class StoredDomainEvent implements DomainEvent
{
    use ImplementsDomainEvent;

    /**
     * @var int|null
     * @phpstan-ignore-next-line
     */
    private $id;

    /**
     * @var string
     */
    private $domainEventType;

    /**
     * @var string
     */
    private $body;

    /**
     * @param Id $entityId
     * @param int $domainEventVersion
     * @param string $domainEventType
     * @param string $body
     * @param \DateTimeImmutable $occurredOn
     */
    public function __construct(Id $entityId, int $domainEventVersion, string $domainEventType, string $body, \DateTimeImmutable $occurredOn)
    {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->domainEventType = $domainEventType;
        $this->body = $body;
        $this->occurredOn = $occurredOn;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return $this->domainEventType;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
