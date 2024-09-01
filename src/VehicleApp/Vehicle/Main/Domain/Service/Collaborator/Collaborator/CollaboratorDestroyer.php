<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Collaborator;

use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;

class CollaboratorDestroyer
{
    /**
     * 
     *
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * @param CollaboratorRepository $collaboratorRepository
     */
    public function __construct(CollaboratorRepository $collaboratorRepository)
    {
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * 
     *
     * @param Collaborator $collab
     * @return void
     */
    public function destroy(Collaborator $collab): void
    {
        $this->collaboratorRepository->remove($collab);
    }
}
