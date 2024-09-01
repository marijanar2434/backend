<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Repository;

use App\Common\Domain\ValueObject\Id;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\RefreshToken;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Entity\RefreshTokenEntity;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\RefreshTokenRepository as AppRefreshTokenRepository;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    /**
     * @var AppRefreshTokenRepository $appRefreshTokenRepository
     */
    private $appRefreshTokenRepository;

    /**
     * RefreshTokenRepository Constructor
     *
     * @param AppRefreshTokenRepository $appRefreshTokenRepository
     */
    public function __construct(AppRefreshTokenRepository $appRefreshTokenRepository)
    {
        $this->appRefreshTokenRepository = $appRefreshTokenRepository;
    }

    /**
     * @inheritDoc
     */
    public function getNewRefreshToken(): ?RefreshTokenEntityInterface
    {
        return null;

        // $refreshToken = new RefreshTokenEntity();
        // $refreshToken->setIdentifier($this->appRefreshTokenRepository->nextIdentity());

        // return $refreshToken;
    }

    /**
     * @inheritDoc
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        $appRefreshToken = new RefreshToken(
            new Id(),
            $refreshTokenEntity->getIdentifier(),
            $refreshTokenEntity->getAccessToken()->getIdentifier(),
            false,
            $refreshTokenEntity->getExpiryDateTime()
        );

        $this->appRefreshTokenRepository->save($appRefreshToken);
    }

    /**
     * @inheritDoc
     */
    public function revokeRefreshToken($tokenId)
    {
        $appRefreshToken = $this->appRefreshTokenRepository->findByIdentifier(new Id($tokenId));

        if (!empty($appRefreshToken)) {
            $appRefreshToken->revoke();
        }
    }

    /**
     * @inheritDoc
     */
    public function isRefreshTokenRevoked($tokenId): bool
    {
        $appRefreshToken = $this->appRefreshTokenRepository->findByIdentifier(new Id($tokenId));

        if (empty($appRefreshToken)) {
            return true;
        }

        return $appRefreshToken->getRevoked();
    }
}
