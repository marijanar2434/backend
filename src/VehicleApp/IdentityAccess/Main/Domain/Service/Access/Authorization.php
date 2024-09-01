<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Access;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AuthorizationFailed;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AuthorizationSucceed;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AuthorizationAttempted;

class Authorization
{
    /**
     * @var AuthorizationStrategy
     */
    private $strategy;

    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * Authorization Constructor
     *
     * @param AuthorizationStrategy $strategy
     * @param EventStore $eventStore
     */
    public function __construct(AuthorizationStrategy $strategy, EventStore $eventStore)
    {
        $this->strategy = $strategy;
        $this->eventStore = $eventStore;
    }

    /**
     * @param string $attribute
     * @param string $subject
     *
     * @return boolean
     */
    public function authorize(Id $userId, string $attribute, string $subject = null): bool
    {
        $this->eventStore->append(
            new AuthorizationAttempted($userId, $attribute, $subject)
        );

        $response = $this->strategy->authorize(
            new AuthorizationRequest(
                $attribute,
                $subject
            )
        );

        $this->eventStore->append(
            $response ? new AuthorizationSucceed($userId, $attribute, $subject) : new AuthorizationFailed($userId, $attribute, $subject)
        );

        return $response;
    }
}
