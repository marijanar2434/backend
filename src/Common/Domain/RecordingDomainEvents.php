<?php

namespace App\Common\Domain;

use App\Common\Domain\Event\DomainEvent;

interface RecordingDomainEvents
{
    /**
     * @return DomainEvent[]
     */
    public function getRecordedDomainEvents(): array;

    /**
     * @return void
     */
    public function clearRecordedDomainEvents(): void;
}
