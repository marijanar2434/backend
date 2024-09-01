<?php
namespace App\VehicleApp\Vehicle\Main\Domain\Event\Brand;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;
use DateTimeImmutable;

class BrandCreated implements DomainEvent, StorableDomainEvent, PublishableDomainEvent
{
    use ImplementsDomainEvent;

    
    /**
     * 
     *
     * @var array
     */
    private  $changes;


    /**
     * 
     *
     * @var string
     */
    private  $name;

    public function __construct(Id $id,string $name, array $changes = [])
    {
        $this->entityId = $id;
        $this->name = $name;
        $this->changes = $changes;
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return 'BrandCreated';
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of changes
     */ 
    public function getChanges()
    {
        return $this->changes;
    }
}
