<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Access;

use App\Common\Domain\Validator\Validator;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\Specification\UniqueIdentifierSpecification;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Access\Specification\UniqueNameSpecification;

class RoleValidator extends Validator
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleValidator Constructor
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Role with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        if (!$this->hasUniqueIdentifier($object)) {
            $notificationHandler->addNotification(
                'Role with identifier {{ identifier }} already exists.',
                ['{{ identifier }}' => $object->getIdentifier()],
                'identifier'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(Role $role): bool
    {
        return (new UniqueNameSpecification($this->roleRepository))->isSatisfiedBy($role);
    }

    /**
     * @return boolean
     */
    private function hasUniqueIdentifier(Role $role): bool
    {
        return (new UniqueIdentifierSpecification($this->roleRepository))->isSatisfiedBy($role);
    }
}
