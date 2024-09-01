<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity;

use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemUserCannotBeDeleted;

class UserDestroyer
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserDestroyer Constructor
     * 
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * 
     * @return void
     */
    public function destroy(User $user): void
    {
        if ($user->isSystemUser()) {
            throw new SystemUserCannotBeDeleted();
        }

        $this->userRepository->remove($user);
    }
}
