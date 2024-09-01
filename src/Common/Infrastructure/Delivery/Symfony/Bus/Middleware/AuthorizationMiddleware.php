<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Bus\Middleware;

use App\Common\Application\Query\Query;
use Symfony\Component\Messenger\Envelope;
use App\Common\Application\Command\Command;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;
use App\Common\Infrastructure\Delivery\Symfony\Bus\Exception\UnauthorizedExecutionException;

class AuthorizationMiddleware implements MiddlewareInterface
{
    /**
     * @var Security
     */
    private $security;

    /**
     * AuthorizationMiddleware Constructor
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @inheritDoc
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (!$envelope->getMessage() instanceof Command && !$envelope->getMessage() instanceof Query) {
            return $stack->next()->handle($envelope, $stack);
        }

        if (!$envelope->getMessage() instanceof RequiresAuthorization) {
            return $stack->next()->handle($envelope, $stack);
        }

        if (!$this->security->isGranted('ROLE_EXECUTE_ACTION', $envelope->getMessage())) {
            throw new UnauthorizedExecutionException('unauthorized.execution');
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
