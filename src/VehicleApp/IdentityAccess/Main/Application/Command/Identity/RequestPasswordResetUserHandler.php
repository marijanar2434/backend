<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;

class RequestPasswordResetUserHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * RequestPasswordResetUserHandler Constructor
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
    public function __invoke(RequestPasswordResetUserCommand $command)
    {
        $user = $this->userRepository->findByEmail($command->getEmail());

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        $user->requestPasswordReset();

        $this->userRepository->save($user);
    }
}
