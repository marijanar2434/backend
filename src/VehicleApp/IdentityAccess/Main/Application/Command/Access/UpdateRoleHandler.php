<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\RoleValidator;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemRoleCannotBeModified;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\SystemRoleCannotBeModifiedException;

class UpdateRoleHandler implements CommandHandler
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
     * UpdateRoleHandler Constructor
     *
     * @param RoleRepository $roleRepository
     * @param RoleValidator $roleValidator
     */
    public function __construct(RoleRepository $roleRepository, RoleValidator $roleValidator)
    {
        $this->roleRepository = $roleRepository;
        $this->roleValidator = $roleValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(UpdateRoleCommand $command)
    {
        /**
         * @var Role|null
         */
        $role = $this->roleRepository->findById(new Id($command->getId()));

        if (empty($role)) {
            throw new RoleNotFoundException();
        }

        try {
            $role->updateProperties(
                $command->getName(),
                $command->getIdentifier(),
                $command->getActive(),
            );
        } catch (SystemRoleCannotBeModified $e) {
            throw new SystemRoleCannotBeModifiedException();
        }

        $validationNotificationHandler = $this->roleValidator->validate($role);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->roleRepository->save($role);
    }
}
