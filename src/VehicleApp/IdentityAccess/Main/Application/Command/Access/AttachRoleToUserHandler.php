<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\UserValidator;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;

class AttachRoleToUserHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var UserValidator
     */
    private $userValidator;

    /**
     * AttachRoleToUserHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param UserValidator $userValidator
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        UserValidator $userValidator,
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userValidator = $userValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(AttachRoleToUserCommand $command)
    {
        /**
         * @var User|null
         */
        $user = $this->userRepository->findById(new Id($command->getUserId()));

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        /**
         * @var Role|null
         */
        $role = $this->roleRepository->findById(new Id($command->getRoleId()));

        if (empty($role)) {
            throw new RoleNotFoundException();
        }

        if (!$user->hasRole($role)) {
            $user->attachRole($role);
        }

        $validationNotificationHandler = $this->userValidator->validate($user);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->userRepository->save($user);
    }
}
