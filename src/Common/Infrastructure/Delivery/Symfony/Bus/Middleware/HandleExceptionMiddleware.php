<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Bus\Middleware;

use Symfony\Component\Messenger\Envelope;
use App\Common\Application\Exception\ExceptionHandler;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class HandleExceptionMiddleware implements MiddlewareInterface
{
    /**
     * @var ExceptionHandler
     */
    private $exceptionHandler;

    /**
     * HandleExceptionMiddleware Constructor
     *
     * @param ExceptionHandler $exceptionHandler
     */
    public function __construct(ExceptionHandler $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * @inheritDoc
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $next = null;

        try {
            $next = $stack->next()->handle($envelope, $stack);
        } catch (HandlerFailedException $e) {
            $exceptions = $e->getNestedExceptions();
            $this->exceptionHandler->handle($exceptions[0] ?? new \Exception($e->getMessage()));
        }

        return $next;
    }
}
