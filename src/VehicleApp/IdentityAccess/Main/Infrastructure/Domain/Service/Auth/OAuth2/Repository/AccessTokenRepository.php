<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Repository;

use App\Common\Domain\ValueObject\Id;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\AccessToken;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Entity\AccessTokenEntity;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\AccessTokenRepository as AppAccessTokenRepository;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    /**
     * @var AppAccessTokenRepository
     */
    private $appAccessTokenRepository;

    /**
     * AccessTokenRepository Constructor
     *
     * @param AppAccessTokenRepository $appAccessTokenRepository
     */
    public function __construct(AppAccessTokenRepository $appAccessTokenRepository)
    {
        $this->appAccessTokenRepository = $appAccessTokenRepository;
    }

    /**
     * @inheritDoc
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null): AccessTokenEntityInterface
    {
        $accessToken = new AccessTokenEntity();
        $accessToken->setClient($clientEntity);
        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }
        $accessToken->setUserIdentifier($userIdentifier);

        return $accessToken;
    }

    /**
     * @inheritDoc
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        $appAccessToken = new AccessToken(
            new Id(),
            $accessTokenEntity->getIdentifier(),
            new Id($accessTokenEntity->getUserIdentifier()),
            new Id($accessTokenEntity->getClient()->getIdentifier()),
            $accessTokenEntity->getScopes(),
            false,
            $accessTokenEntity->getExpiryDateTime()
        );

        $this->appAccessTokenRepository->save($appAccessToken);
    }

    /**
     * @inheritDoc
     */
    public function revokeAccessToken($tokenId): void
    {
        $appAccessToken = $this->appAccessTokenRepository->findByIdentifier(
            new Id($tokenId)
        );

        if (!empty($appAccessToken)) {
            $appAccessToken->revoke();
        }
    }

    /**
     * @inheritDoc
     */
    public function isAccessTokenRevoked($tokenId): bool
    {
        $appAccessToken = $this->appAccessTokenRepository->findByIdentifier(
            new Id($tokenId)
        );

        if (empty($appAccessToken)) {
            return true;
        }

        return $appAccessToken->getRevoked();
    }
}
