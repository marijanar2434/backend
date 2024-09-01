<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\MaintenanceTypeValidator;

class CreateMaintenanceTypeHandler implements CommandHandler
{
    /**
     * 
     *
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;

    /**
     * 
     *
     * @var MaintenanceTypeValidator
     */
    private $maintenanceTypeValidator;



    public function __construct(
        MaintenanceTypeRepository $maintenanceTypeRepository,
        MaintenanceTypeValidator $maintenanceTypeValidator
    ) {
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
        $this->maintenanceTypeValidator = $maintenanceTypeValidator;
    }

    public function __invoke(CreateMaintenanceTypeCommand $command)
    {

        $maintenanceType = new MaintenanceType(
            new Id($command->getId()),
            $command->getName()
        );

        /**
         *@var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->maintenanceTypeValidator->validate($maintenanceType);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }


        $this->maintenanceTypeRepository->save($maintenanceType);
    }
}
