<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\CollabType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CollabTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;

class UpdateCollabTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var CollabTypeRepository
     */
    private $collabTypeRepository;


    public function __construct(
        CollabTypeRepository $collabTypeRepository
    ) {
        $this->collabTypeRepository = $collabTypeRepository;
    }

    public function __invoke(UpdateCollabTypeCommand $command)
    {

        /**
         * @var CollabType|null
         */
        $collabType = $this->collabTypeRepository->findById(new Id($command->getId()));

        if (empty($collabType)) {
            throw new CollabTypeNotFoundException();
        }

        $collabType->updateProperties(
            $command->getName()
        );


        $this->collabTypeRepository->save($collabType);
    }
}
