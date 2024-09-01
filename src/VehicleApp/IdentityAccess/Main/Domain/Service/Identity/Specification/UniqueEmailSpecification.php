<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\Specification;

use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;

class UniqueEmailSpecification extends Specification
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UniqueEmailSpecification Constructor
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
        $user = $this->userRepository->findByEmail(
            $object->getEmail()
        );

        return $user === null || $object->getId()->equals($user->getId());
    }
}
