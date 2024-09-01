<?php

namespace App\Common\Infrastructure\Application\Bus;

use Symfony\Component\Messenger\Envelope;
use App\Common\Application\Bus\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus implements CommandBus
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    /**
     * SymfonyCommandBus Constructor
     * 
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $command
     *
     * @return Envelope The handler returned value
     */
    public function handle($command): Envelope
    {
        return $this->messageBus->dispatch($command);
    }
}
