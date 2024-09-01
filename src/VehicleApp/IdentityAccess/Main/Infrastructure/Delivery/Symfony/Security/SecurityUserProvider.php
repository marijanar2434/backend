<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Security;

use Ramsey\Uuid\Uuid;
use App\Common\Domain\ValueObject\Id;
use Symfony\Component\Security\Core\User\UserInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;

class SecurityUserProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserProvider Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        try {
            /**
             * @var User|null
             */
            $user = Uuid::isValid($identifier) ?
                $this->userRepository->findById(new Id($identifier)) : $this->userRepository->findByUsername($identifier);
        } catch (\Exception $e) {
            throw new UserNotFoundException();
        }

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        $roles = [];
        foreach ($user->getRoles() as $r) {
            $roles[] = $r->getIdentifier();
        }

        return new SecurityUser(
            $user->getId()->getId(),
            $user->getFullName(),
            $user->getUsername(),
            $user->getEmail(),
            $user->getAvatar()?->getFile(),
            $roles,
        );
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername(string $username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass(string $class): bool
    {
        return true;
    }
}
