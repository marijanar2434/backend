<?php


namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Entity;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\ScopeTrait;

class ScopeEntity implements ScopeEntityInterface
{
    use EntityTrait, ScopeTrait;

    /**
     * Serialize the object to the scopes string identifier when using json_encode().
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->getIdentifier();
    }
}
