<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth;

use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AuthenticationFailed;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AuthenticationSucceed;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AuthenticationAttempted;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationResponse;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationStrategy;

class Authentication
{
    /**
     * @var AuthenticationStrategy
     */
    private $strategy;

    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * Authentication Constructor
     *
     * @param AuthenticationStrategy $strategy
     * @param EventStore $eventStore
     */
    public function __construct(AuthenticationStrategy $strategy, EventStore $eventStore)
    {
        $this->strategy = $strategy;
        $this->eventStore = $eventStore;
    }

    /**
     * @param string $identity
     * @param string $password
     *
     * @return AuthenticationResponse
     */
    public function authenticate(string $identity, string $password = null): AuthenticationResponse
    {
        $this->eventStore->append(
            new AuthenticationAttempted($identity)
        );

        $response = $this->strategy->authenticate(
            new AuthenticationRequest(
                $identity,
                $password
            )
        );

        $this->eventStore->append(
            $response->getSuccess() ? new AuthenticationSucceed($identity) : new AuthenticationFailed($identity)
        );

        return $response;
    }
}
