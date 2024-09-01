<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Bus;

use Symfony\Component\Messenger\Envelope;
use App\Common\Application\Bus\CommandBus;
use App\Common\Application\Exception\ExceptionHandler;

class ExceptionHandlingCommandBus implements CommandBus
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var ExceptionHandler
     */
    private $exceptionHandler;

    /**
     * ExceptionHandlingCommandBus Constructor
     * 
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus, ExceptionHandler $exceptionHandler)
    {
        $this->commandBus = $commandBus;
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * @param object|Envelope $command
     *
     * @return mixed 
     */
    public function handle($command): mixed
    {
        $response = null;

        try {
            $response = $this->commandBus->handle($command);
        } catch (\Exception $e) {
            $this->exceptionHandler->handle($e);
        }

        return $response;
    }
}
