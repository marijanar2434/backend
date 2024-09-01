<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Event\Registration;

use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\ValueObject\Id;
use DateTimeImmutable;

class RegistrationCreated implements DomainEvent, PublishableDomainEvent, StorableDomainEvent
{
    use ImplementsDomainEvent;


    /**
     * 
     *
     * @var string
     */
    private  $message;

    /**
     * 
     *
     * @var string
     */
    private $user;


    public function __construct(Id $entityId,string $user, string $message = "New registration added.")
    {

        $this->entityId = $entityId;
        $this->user = $user;
        $this->message = $message;
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function getDomainEventType(): string
    {
        return 'RegistrationCreated';
    }



    /**
     * Get the value of message
     *
     * @return  string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get the value of user
     *
     * @return  string
     */ 
    public function getUser()
    {
        return $this->user;
    }
}
