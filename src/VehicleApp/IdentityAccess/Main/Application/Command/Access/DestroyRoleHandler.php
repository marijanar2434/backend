<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\RoleDestroyer;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\RoleIsAttachedToUser;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemRoleCannotBeDeleted;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleIsAttachedToUserException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\SystemRoleCannotBeDeletedException;

class DestroyRoleHandler implements CommandHandler
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var RoleDestroyer
     */
    private $roleDestroyer;

    /**
     * DestroyRoleHandler Constructor
     *
     * @param RoleRepository $roleRepository
     * @param RoleDestroyer $roleDestroyer
     */
    public function __construct(RoleRepository $roleRepository, RoleDestroyer $roleDestroyer)
    {
        $this->roleRepository = $roleRepository;
        $this->roleDestroyer = $roleDestroyer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DestroyRoleCommand $command)
    {
        /**
         * @var Role|null
         */
        $role = $this->roleRepository->findById(new Id($command->getId()));

        if (empty($role)) {
            throw new RoleNotFoundException();
        }

        try {
            $this->roleDestroyer->destroy($role);
        } catch (RoleIsAttachedToUser $e) {
            throw new RoleIsAttachedToUserException();
        } catch (SystemRoleCannotBeDeleted $e) {
            throw new SystemRoleCannotBeDeletedException();
        }
    }
}
