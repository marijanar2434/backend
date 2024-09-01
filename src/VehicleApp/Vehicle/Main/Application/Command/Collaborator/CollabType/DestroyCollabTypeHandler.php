<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\CollabType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CollabTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\CollabType\CollabTypeIsAttachedToCollaboratorException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\CollabType\CollabTypeIsAttachedToCollaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\CollabType\CollabTypeDestroyer;

class DestroyCollabTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var CollabTypeRepository
     */
    private  $collabTypeRepository;

    /**
     * 
     *
     * @var CollabTypeDestroyer
     */
    private  $collabTypeDestroyer;


    /**
     * 
     *
     * @param CollabTypeRepository $collabTypeRepository
     * @param CollabTypeDestroyer $collabTypeDestroyer
     */
    public function __construct(CollabTypeRepository $collabTypeRepository, CollabTypeDestroyer $collabTypeDestroyer)
    {
        $this->collabTypeRepository = $collabTypeRepository;
        $this->collabTypeDestroyer = $collabTypeDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyCollabTypeCommand $command)
    {


        /**
         * @var CollabType|null
         */
        $collabType = $this->collabTypeRepository->findById(new Id($command->getId()));

        if (empty($collabType)) {
            throw new CollabTypeNotFoundException();
        }


        try {   
            $this->collabTypeDestroyer->destroy($collabType);
        } catch (CollabTypeIsAttachedToCollaborator) {
            throw new CollabTypeIsAttachedToCollaboratorException();
        }
        
    }
}

