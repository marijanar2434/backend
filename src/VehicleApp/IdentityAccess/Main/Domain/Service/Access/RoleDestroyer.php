<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Access;

use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\RoleIsAttachedToUser;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemRoleCannotBeDeleted;

class RoleDestroyer
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
     * RoleDestroyer Constructor
     * 
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Role $role
     * 
     * @return void
     */
    public function destroy(Role $role): void
    {
        $userCount = $this->userRepository->countByRoleId($role->getId());

        if ($userCount > 0) {
            throw new RoleIsAttachedToUser();
        }

        if ($role->isSystemRole()) {
            throw new SystemRoleCannotBeDeleted();
        }

        $this->roleRepository->remove($role);
    }
}
