<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\Common\Application\Exception\ValidationServiceException;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\RoleValidator;

class CreateRoleHandler implements CommandHandler
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var RoleValidator
     */
    private $roleValidator;

    /**
     * CreateRoleHandler Constructor
     *
     * @param RoleRepository $roleRepository
     * @param RoleValidator $roleValidator
     */
    public function __construct(
        RoleRepository $roleRepository,
        RoleValidator $roleValidator,
    ) {
        $this->roleRepository = $roleRepository;
        $this->roleValidator = $roleValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CreateRoleCommand $command)
    {
        $role = new Role(
            new Id($command->getId()),
            $command->getName(),
            $command->getIdentifier(),
            $command->getActive()
        );

        $validationNotificationHandler = $this->roleValidator->validate($role);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->roleRepository->save($role);
    }
}
