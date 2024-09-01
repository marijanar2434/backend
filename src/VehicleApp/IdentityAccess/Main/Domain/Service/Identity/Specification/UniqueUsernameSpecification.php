<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\Specification;

use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;

class UniqueUsernameSpecification extends Specification
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UniqueUsernameSpecification Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $user = $this->userRepository->findByUsername(
            $object->getUsername()
        );

        return $user === null || $object->getId()->equals($user->getId());
    }
}
