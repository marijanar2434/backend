<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\CollabType\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var CollabTypeRepository
     */
    private  $collabTypeRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param CollabTypeRepository $collabTypeRepository
     */
    public function __construct(CollabTypeRepository $collabTypeRepository)
    {
        $this->collabTypeRepository = $collabTypeRepository;
    }

    /**
     * @param  CollabType$object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        
        $collabType = $this->collabTypeRepository->findByName($object->getName());

        return $collabType === null || $object->getId()->equals($collabType->getId());
    }
}

