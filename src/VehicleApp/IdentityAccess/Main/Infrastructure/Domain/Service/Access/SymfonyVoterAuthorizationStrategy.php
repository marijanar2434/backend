<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Access;

use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\AuthorizationRequest;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\AuthorizationStrategy;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SymfonyVoterAuthorizationStrategy implements AuthorizationStrategy
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * SymfonyVoterAuthorizationStrategy Constructor
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @inheritDoc
     */
    public function authorize(AuthorizationRequest $authorizationRequest): bool
    {
        return $this->authorizationChecker->isGranted($authorizationRequest->getAttribute(), $authorizationRequest->getSubject());
    }
}
