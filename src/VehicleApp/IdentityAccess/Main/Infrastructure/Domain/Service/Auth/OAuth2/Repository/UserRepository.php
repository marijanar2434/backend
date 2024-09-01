<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Repository;

use App\Common\Infrastructure\Service\Hasher\Hasher;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository as AppUserRepository;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Entity\UserEntity;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var AppUserRepository
     */
    private $appUserRepository;

    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * UserRepository Constructor
     *
     * @param AppUserRepository $appUserRepository
     * @param Hasher $hasher
     */
    public function __construct(AppUserRepository $appUserRepository, Hasher $hasher)
    {
        $this->appUserRepository = $appUserRepository;
        $this->hasher = $hasher;
    }

    /**
     * @inheritDoc
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity): ?UserEntityInterface
    {
        $appUser = null;
        if (empty($appUser = $appUser = $this->appUserRepository->findByEmail($username))) {
            $appUser = $appUser = $this->appUserRepository->findByUsername($username);
        }

        if (empty($appUser)) {
            throw OAuthServerException::invalidCredentials();
        }

        if (!$appUser->getActive()) {
            throw new OAuthServerException('user.not.active', 3, 'invalid_request', 400);
        }

        $isPasswordValid = $this->hasher->verify($password, $appUser->getPassword());
        if (!$isPasswordValid) {
            throw OAuthServerException::invalidCredentials();
        }

        $user = new UserEntity();
        $user->setIdentifier($appUser->getId()->getId());
        return $user;
    }
}
