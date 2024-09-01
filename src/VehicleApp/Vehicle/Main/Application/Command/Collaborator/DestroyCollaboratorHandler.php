<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CollaboratorNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Collaborator\CollaboratorDestroyer;

class DestroyCollaboratorHandler implements CommandHandler
{

    /**
     * 
     *
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * 
     *
     * @var CollaboratorDestroyer
     */
    private CollaboratorDestroyer $collaboratorDestroyer;


    /**
     * 
     *
     * @param CollaboratorRepository $collaboratorRepository
     * @param CollaboratorDestroyer $collaboratorDestroyer
     */
    public function __construct(CollaboratorRepository $collaboratorRepository, CollaboratorDestroyer $collaboratorDestroyer)
    {
        $this->collaboratorRepository = $collaboratorRepository;
        $this->collaboratorDestroyer = $collaboratorDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyCollaboratorCommand $command)
    {


        /**
         * @var Collaborator|null
         */
        $collaborator = $this->collaboratorRepository->findById(new Id($command->getId()));

        if (empty($collaborator)) {
            throw new CollaboratorNotFoundException();
        }


        $this->collaboratorDestroyer->destroy($collaborator);
    }
}

