<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\CollabType\Specification\UniqueNameSpecification;

class CollabTypeValidator extends Validator
{
    /**
     * @var CollabTypeRepository
     */ 
    private $collabTypeRepository;

    /**
     * BrandValidator Constructor
     *
     * @param CollabTypeRepository $collabTypeRepository
     */
    public function __construct(CollabTypeRepository $collabTypeRepository)
    {
        $this->collabTypeRepository = $collabTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Collab type with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(CollabType $collabType): bool
    {
        return (new UniqueNameSpecification($this->collabTypeRepository))->isSatisfiedBy($collabType);
    }
}
