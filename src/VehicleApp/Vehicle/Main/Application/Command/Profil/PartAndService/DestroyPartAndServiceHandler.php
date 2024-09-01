<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\PartAndService;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceIsAttachedToDamageException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceIsAttachedToMaintenanceException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartIsAttachedToMaintenanceException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\PartAndService\PartAndServicesIsAttachedToDamage;
use App\VehicleApp\Vehicle\Main\Domain\Exception\PartAndService\PartAndServicesIsAttachedToMaintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\PartAndService\PartAndServiceDestroyer;

class DestroyPartAndServiceHandler implements CommandHandler
{

    /**
     * 
     *
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;

    /**
     * 
     *
     * @var PartAndServiceDestroyer
     */
    private $partAndServiceDestroyer;


    /**
     * 
     *
     * @param PartAndServiceRepository $partAndServiceRepository
     * @param PartAndServiceDestroyer $partAndServiceDestroyer
     */
    public function __construct(PartAndServiceRepository $partAndServiceRepository, PartAndServiceDestroyer $partAndServiceDestroyer)
    {
        $this->partAndServiceRepository = $partAndServiceRepository;
        $this->partAndServiceDestroyer = $partAndServiceDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyPartAndServiceCommand $command)
    {
        /**
         * @var PartAndService|null
         */

        $partAndService = $this->partAndServiceRepository->findById(new Id($command->getId()));

        if (empty($partAndService)) {
            throw new PartAndServiceNotFoundException();
        }

        try {
            $this->partAndServiceDestroyer->destroy($partAndService);
        } catch (PartAndServicesIsAttachedToDamage) {
            throw new PartAndServiceIsAttachedToDamageException();
        } catch (PartAndServicesIsAttachedToMaintenance) {
            throw new PartIsAttachedToMaintenanceException();
        }
    }
}
