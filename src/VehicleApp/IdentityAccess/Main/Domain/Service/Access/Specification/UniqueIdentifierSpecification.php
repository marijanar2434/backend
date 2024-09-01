<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\Specification;

use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;

class UniqueIdentifierSpecification extends Specification
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UniqueIdentifierSpecification Constructor
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Role $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $role = $this->roleRepository->findByIdentifier(
            $object->getIdentifier()
        );

        return $role === null || $object->getId()->equals($role->getId());
    }
}
