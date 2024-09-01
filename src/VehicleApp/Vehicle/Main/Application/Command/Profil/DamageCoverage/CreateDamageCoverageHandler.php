<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\DamageCoverageValidator;

class CreateDamageCoverageHandler implements CommandHandler
{
    /**
     * 
     *
     * @var DamageCoverageRepository
     */
    private $damageCoverageRepository;

    /**
     * 
     *
     * @var DamageCoverageValidator
     */
    private $damageCoverageValidator;



    public function __construct(
        DamageCoverageRepository $damageCoverageRepository,
        DamageCoverageValidator $damageCoverageValidator
    ) {
        $this->damageCoverageRepository = $damageCoverageRepository;
        $this->damageCoverageValidator = $damageCoverageValidator;
    }

    public function __invoke(CreateDamageCoverageCommand $command)
    {

        $damageCoverage = new DamageCoverage(
            new Id($command->getId()),
            $command->getName()
        );

        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->damageCoverageValidator->validate($damageCoverage);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }
        $this->damageCoverageRepository->save($damageCoverage);
    }
}


