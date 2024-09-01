<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\UserDestroyer;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemUserCannotBeDeleted;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\SystemUserCannotBeDeletedException;

class DestroyUserHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserDestroyer
     */
    private $userDestroyer;

    /**
     * DestroyUserHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param UserDestroyer $userDestroyer
     */
    public function __construct(UserRepository $userRepository, UserDestroyer $userDestroyer)
    {
        $this->userRepository = $userRepository;
        $this->userDestroyer = $userDestroyer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DestroyUserCommand $command)
    {
        /**
         * @var User|null
         */
        $user = $this->userRepository->findById(new Id($command->getId()));

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        try {
            $this->userDestroyer->destroy($user);
        } catch (SystemUserCannotBeDeleted) {
            throw new SystemUserCannotBeDeletedException();
        }
    }
}
