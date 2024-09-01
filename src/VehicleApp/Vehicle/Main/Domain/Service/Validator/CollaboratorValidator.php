<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Collaborator\Specification\UniqueSpecification;

class CollaboratorValidator extends Validator
{
    /**
     * @var CollaboratorRepository
     */
    private  $collaboratorRepository;

    /**
     * BrandValidator Constructor
     *
     * @param CollaboratorRepository $collaboratorRepository
     */
    public function __construct(CollaboratorRepository $collaboratorRepository)
    {
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();
        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Collaborator with company [ {{ company }} ] and client [ {{ client }} ] already exists.',
                [
                    '{{ company }}' => $object->getCompany()->getName(),
                    '{{ client }}' => $object->getClient()->getFullName()
                ]
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(Collaborator $collaborator): bool
    {
        return (new UniqueSpecification($this->collaboratorRepository))->isSatisfiedBy($collaborator);
    }
}
