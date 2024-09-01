<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity;

use App\Common\Domain\Validator\Validator;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\Specification\UniqueEmailSpecification;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Identity\Specification\UniqueUsernameSpecification;

class UserValidator extends Validator
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserValidator Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueUsername($object)) {
            $notificationHandler->addNotification(
                'User with username {{ username }} already exists.',
                ['{{ username }}' => $object->getUsername()],
                'username'
            );
        }

        if (!$this->hasUniqueEmail($object)) {
            $notificationHandler->addNotification(
                'User with email {{ email }} already exists.',
                ['{{ email }}' => $object->getEmail()],
                'email'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueUsername(User $user): bool
    {
        return (new UniqueUsernameSpecification($this->userRepository))->isSatisfiedBy($user);
    }

    /**
     * @return boolean
     */
    private function hasUniqueEmail(User $user): bool
    {
        return (new UniqueEmailSpecification($this->userRepository))->isSatisfiedBy($user);
    }
}
