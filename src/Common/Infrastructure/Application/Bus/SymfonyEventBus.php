<?php

namespace App\Common\Infrastructure\Application\Bus;

use App\Common\Application\Bus\EventBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyEventBus implements EventBus
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    /**
     * SymfonyEventBus Constructor
     * 
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $event
     *
     * @return Envelope The handler returned value
     */
    public function handle($event): Envelope
    {
        return $this->messageBus->dispatch($event);
    }
}
