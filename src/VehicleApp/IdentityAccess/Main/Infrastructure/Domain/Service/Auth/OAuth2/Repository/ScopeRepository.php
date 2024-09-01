<?php


namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Repository;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Entity\ScopeEntity;

class ScopeRepository implements ScopeRepositoryInterface
{
    /**
     * @var array
     */
    public const SCOPES = [
        '*' => [
            'description' => 'All',
        ],
        'basic' => [
            'description' => 'Basic details',
        ],
        'email' => [
            'description' => 'Email address',
        ],
    ];

    /**
     * @inheritDoc
     */
    public function getScopeEntityByIdentifier($scopeIdentifier): ?ScopeEntityInterface
    {
        if (array_key_exists($scopeIdentifier, self::SCOPES) === false) {
            return null;
        }

        $scope = new ScopeEntity();
        $scope->setIdentifier($scopeIdentifier);

        return $scope;
    }

    /**
     * @inheritDoc
     */
    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null): array
    {
        $filteredScopes = [];

        foreach ($scopes as $scope) {
            $filteredScopes[] = $scope;
        }

        return $filteredScopes;
    }
}
