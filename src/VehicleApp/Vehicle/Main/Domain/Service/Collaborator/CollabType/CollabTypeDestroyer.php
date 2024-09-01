<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\CollabType;

use App\VehicleApp\Vehicle\Main\Domain\Exception\CollabType\CollabTypeIsAttachedToCollaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;

class CollabTypeDestroyer
{
    /**
     * 
     *
     * @var CollabTypeRepository
     */
    private $collabTypeRepository;

    /**
     * 
     *
     * @var CollaboratorRepository
     */
    private  $collaboratorRepository;

    /**
     * 
     *
     * @param CollabTypeRepository $collabTypeRepository
     * @param CollaboratorRepository $collaboratorRepository
     */
    public function __construct(CollabTypeRepository $collabTypeRepository, CollaboratorRepository $collaboratorRepository)
    {
        $this->collabTypeRepository = $collabTypeRepository;
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * 
     *
     * @param CollabType $collabType
     * @return void
     */
    public function destroy(CollabType $collabType): void
    {

        $res = $this->collaboratorRepository->countByCollabTypetId($collabType->getId());
        if ($res > 0) {
            throw new CollabTypeIsAttachedToCollaborator();
        }


        $this->collabTypeRepository->remove($collabType);
    }
}
