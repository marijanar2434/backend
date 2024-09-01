<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Bus\Middleware;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class PublishDomainEventsAfterCurrentBusMiddleware implements MiddlewareInterface
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * PublishDomainEventsAfterCurrentBusMiddleware Constructor
     *
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    /**
     * @inheritDoc
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        try {
            return $stack->next()->handle($envelope, $stack);
        } finally {
            $this->eventStore->publish();
        }
    }
}
