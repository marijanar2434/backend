<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Collaborator\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;

class UniqueSpecification extends Specification
{
    /**
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param CollaboratorRepository $collaboratorRepository
     */
    public function __construct(CollaboratorRepository $collaboratorRepository)
    {
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * @param  Collaborator$object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        
        $collaborator = $this->collaboratorRepository->FindByClientAndCompany($object->getClient(),$object->getCompany());

        return $collaborator === null || $object->getId()->equals($collaborator->getId());
    }
}



