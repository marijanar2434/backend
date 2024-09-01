<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\PartAndService;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;

class UpdatePartAndServiceHandler implements CommandHandler
{

    /**
     * 
     *
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;



    public function __construct(
        PartAndServiceRepository $partAndServiceRepository
    ) {
        $this->partAndServiceRepository = $partAndServiceRepository;
    }

    public function __invoke(UpdatePartAndServiceCommand $command)
    {

        /**
         * @var PartAndService|null
         */
         $partAndService = $this->partAndServiceRepository->findById(new Id($command->getId()));
       
        if (empty($partAndService)) {
            throw new PartAndServiceNotFoundException();
        }

        $partAndService->updateProperties($command->getName());
   
        $this->partAndServiceRepository->save($partAndService);
    }
}
