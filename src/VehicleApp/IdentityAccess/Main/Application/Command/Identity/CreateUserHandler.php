<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\ValueObject\File;
use App\Common\Application\Command\CommandHandler;
use App\Common\Infrastructure\Service\Hasher\Hasher;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\UserValidator;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleNotFoundException;

class CreateUserHandler implements CommandHandler
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
     * @var Hasher
     */
    private $hasher;

    /**
     * @var FileInspector
     */
    private $fileInspector;

    /**
     * @var UserValidator
     */
    private $userValidator;

    /**
     * CreateUserHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param Hasher $hasher
     * @param FileInspector $fileInspector
     * @param UserValidator $userValidator
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        Hasher $hasher,
        FileInspector $fileInspector,
        UserValidator $userValidator
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->hasher = $hasher;
        $this->fileInspector = $fileInspector;
        $this->userValidator = $userValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CreateUserCommand $command)
    {

        $user = new User(
            new Id($command->getId()),
            $command->getFullName(),
            $command->getUsername(),
            $command->getEmail(),
            $this->hasher->hash($command->getPassword()),
            $command->getActive(),
            !empty($command->getAvatar()) ? new File(
                $command->getAvatar(),
                $this->fileInspector->getName($command->getAvatar()),
                $this->fileInspector->getMimeType($command->getAvatar()),
                $this->fileInspector->getExtension($command->getAvatar()),
                $this->fileInspector->getSize($command->getAvatar())
            ) : null
        );
        
       


        $role = $this->roleRepository->findByIdentifier($user->getDefaultRoleIdentifier());

        if (empty($role)) {
            throw new RoleNotFoundException();
        }

        $user->attachRole($role);

        $validationNotificationHandler = $this->userValidator->validate($user);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->userRepository->save($user);
    }
}
