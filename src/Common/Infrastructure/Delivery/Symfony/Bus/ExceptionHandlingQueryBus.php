<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Bus;

use App\Common\Application\Bus\QueryBus;
use Symfony\Component\Messenger\Envelope;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Exception\ExceptionHandler;

class ExceptionHandlingQueryBus implements QueryBus
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @var ExceptionHandler
     */
    private $exceptionHandler;

    /**
     * ExceptionHandlingQueryBus Constructor
     * 
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus, ExceptionHandler $exceptionHandler)
    {
     
        
        $this->queryBus = $queryBus;
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * @param object|Envelope $query
     *
     * @return QueryResult The handler returned value
     */
    public function handle($query): QueryResult
    {
        
        $next = null;
        
        try {
            $next = $this->queryBus->handle($query);
        } catch (\Exception $e) {
            $this->exceptionHandler->handle($e);
        }

        return $next;
    }
}
