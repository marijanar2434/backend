<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\Common\Infrastructure\Service\Hasher\Hasher;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\UserDidNotRequestedPasswordReset;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserDidNotRequestedPasswordResetException;

class PasswordResetUserHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * PasswordResetUserHandler Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, Hasher $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(PasswordResetUserCommand $command)
    {
        /**
         * @var User|null
         */
        $user = $this->userRepository->findById(new Id($command->getUserId()));

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        try {
            $user->passwordReset(
                $command->getPasswordRequestId(),
                $this->hasher->hash($command->getPassword())
            );
        } catch (UserDidNotRequestedPasswordReset $e) {
            throw new UserDidNotRequestedPasswordResetException();
        }

        $this->userRepository->save($user);
    }
}
