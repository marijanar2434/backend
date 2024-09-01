<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\DamageCoverage\DamageCoverageIsAttachedToDamageException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\DamageCoverage\DamageCoverageNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\DamageCoverage\DamageCoverageIsAttachedToDamage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\DamageCoverage\DamageCoverageDestroyer;

class DestroyDamageCoverageHandler implements CommandHandler
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
     * @var DamageCoverageDestroyer
     */
    private $damageCoverageDestroyer;


    /**
     * 
     *
     * @param DamageCoverageRepository $damageCoverageRepository
     * @param DamageCoverageDestroyer $damageCoverageDestroyer
     */
    public function __construct(DamageCoverageRepository $damageCoverageRepository, DamageCoverageDestroyer $damageCoverageDestroyer)
    {
        $this->damageCoverageRepository = $damageCoverageRepository;
        $this->damageCoverageDestroyer = $damageCoverageDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyDamageCoverageCommand $command)
    {
        /**
         * @var DamageCoverage|null
         */

        $damageCoverage = $this->damageCoverageRepository->findById(new Id($command->getId()));

        if (empty($damageCoverage)) {
            throw new DamageCoverageNotFoundException();
        }

        try {
            $this->damageCoverageDestroyer->destroy($damageCoverage);
        } catch (DamageCoverageIsAttachedToDamage) {
            throw new DamageCoverageIsAttachedToDamageException();
        }
    }
}
