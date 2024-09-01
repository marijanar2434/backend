<?php

namespace App\Common\Infrastructure\Application\Bus;

use App\Common\Application\Bus\QueryBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use App\Common\Application\Query\QueryResult;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    /**
     * SymfonyQueryBus Constructor
     * 
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $query
     *
     * @return QueryResult The handler returned value
     */
    public function handle($query): QueryResult
    {
        return $this->handleQuery($query);
    }
}
