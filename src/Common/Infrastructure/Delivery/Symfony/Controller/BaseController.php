<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Controller;

use App\Common\Application\Bus\QueryBus;
use App\Common\Application\Bus\CommandBus;
use App\Common\Application\Exception\ExceptionHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;

abstract class BaseController extends AbstractController
{
    /**
     * @param CommandBus $commandBus
     * @param ExceptionHandler $exceptionHandler
     * 
     * @return ExceptionHandlingCommandBus
     */
    protected function commandBusWithExceptionHandling(CommandBus $commandBus, ExceptionHandler $exceptionHandler): ExceptionHandlingCommandBus
    {
        return new ExceptionHandlingCommandBus($commandBus, $exceptionHandler);
    }

    /**
     * @param QueryBus $queryBus
     * @param ExceptionHandler $exceptionHandler
     * 
     * @return ExceptionHandlingQueryBus
     */
    protected function queryBusWithExceptionHandling(QueryBus $queryBus, ExceptionHandler $exceptionHandler): ExceptionHandlingQueryBus
    {
        return new ExceptionHandlingQueryBus($queryBus, $exceptionHandler);
    }
}
