<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Event\Vehicle;

use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\ValueObject\Id;
use DateTimeImmutable;

class VehicleCreated implements DomainEvent, PublishableDomainEvent, StorableDomainEvent
{
    use ImplementsDomainEvent;


    /**
     * 
     *
     * @var string
     */
    private $chassisNumber;

    /**
     * 
     *
     * @var string
     */
    private $engineNumber;


    /**
     * 
     *
     * @var string
     */
    private $type;


    public function __construct(Id $entityId, string $chassisNumber, string $engineNumber, string $type)
    {
        $this->entityId = $entityId;
        $this->chassisNumber = $chassisNumber;
        $this->engineNumber = $engineNumber;
        $this->type = $type;
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return 'VehicleCreated';
    }

    /**
     * Get the value of chassisNumber
     *
     * @return  string
     */ 
    public function getChassisNumber()
    {
        return $this->chassisNumber;
    }

    /**
     * Get the value of engineNumber
     *
     * @return  string
     */ 
    public function getEngineNumber()
    {
        return $this->engineNumber;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }
}
