<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage\UpdateDamageCommand;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\DamageCoverage\DamageCoverageNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;

class UpdateDamageCoverageHandler implements CommandHandler
{

    /**
     * 
     *
     * @var DamageCoverageRepository
     */
    private   $damageCoverageRepository;



    public function __construct(
        DamageCoverageRepository $damageCoverageRepository
    ) {
        $this->damageCoverageRepository = $damageCoverageRepository;
    }

    public function __invoke(UpdateDamageCoverageCommand $command)
    {

        /**
         * @var DamageCoverage|null
         */
        
         $damageCoverage = $this->damageCoverageRepository->findById(new Id($command->getId()));
       
        if (empty($damageCoverage)) {
            throw new DamageCoverageNotFoundException();
        }

        
         $damageCoverage->updateProperties($command->getName());
   
        $this->damageCoverageRepository->save($damageCoverage);
    }
}
