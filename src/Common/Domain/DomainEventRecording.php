<?php

namespace App\Common\Domain;

use App\Common\Domain\Event\DomainEvent;

trait DomainEventRecording
{
    /**
     * @var DomainEvent[]
     */
    protected $recordedDomainEvents = [];

    /**
     * @return DomainEvent[]
     */
    public function getRecordedDomainEvents(): array
    {
        return $this->recordedDomainEvents;
    }

    /**
     * @return void
     */
    public function clearRecordedDomainEvents(): void
    {
        $this->recordedDomainEvents = [];
    }

    /**
     * @param DomainEvent $domainEvent
     * 
     * @return void
     */
    protected function recordThat(DomainEvent $domainEvent): void
    {
        $this->recordedDomainEvents[] = $domainEvent;
    }

    /**
     * @param DomainEvent $domainEvent
     * 
     * @return void
     */
    protected function recordOnceThat(DomainEvent $domainEvent): void
    {
        foreach ($this->recordedDomainEvents as $key => $dm) {
            if (\get_class($domainEvent) === \get_class($dm)) {
                unset($this->recordedDomainEvents[$key]);
            }
        }

        $this->recordThat($domainEvent);
    }
}
