<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\ValueObject\File;
use App\Common\Application\Command\CommandHandler;
use App\Common\Infrastructure\Service\Hasher\Hasher;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\UserValidator;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemUserCannotBeModified;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\SystemUserCannotBeModifiedException;

class UpdateUserHandler implements CommandHandler
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
     * @var FileInspector
     */
    private $fileInspector;

    /**
     * @var UserValidator
     */
    private $userValidator;

    /**
     * UpdateUserHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param Hasher $hasher
     * @param FileInspector $fileInspector
     * @param UserValidator $userValidator
     */
    public function __construct(
        UserRepository $userRepository,
        Hasher $hasher,
        FileInspector $fileInspector,
        UserValidator $userValidator,
    ) {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
        $this->fileInspector = $fileInspector;
        $this->userValidator = $userValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(UpdateUserCommand $command)
    {
        /**
         * @var User|null
         */
        $user = $this->userRepository->findById(new Id($command->getId()));

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        try {
            $user->updateProperties(
                !empty($command->getFullName()) ? $command->getFullName() : $user->getFullName(),
                !empty($command->getUsername()) ? $command->getUsername() : $user->getUsername(),
                !empty($command->getEmail()) ? $command->getEmail() : $user->getEmail(),
                !empty($command->getPassword()) ? $this->hasher->hash($command->getPassword()) : $user->getPassword(),
                $command->getActive(),
                !empty($command->getAvatar()) ? new File(
                    $command->getAvatar(),
                    $this->fileInspector->getName($command->getAvatar()),
                    $this->fileInspector->getMimeType($command->getAvatar()),
                    $this->fileInspector->getExtension($command->getAvatar()),
                    $this->fileInspector->getSize($command->getAvatar())
                ) : null
            );
        } catch (SystemUserCannotBeModified) {
            throw new SystemUserCannotBeModifiedException();
        }

        $validationNotificationHandler = $this->userValidator->validate($user);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->userRepository->save($user);
    }
}
