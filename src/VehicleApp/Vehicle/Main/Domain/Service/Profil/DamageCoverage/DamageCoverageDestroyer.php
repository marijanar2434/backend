<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\DamageCoverage;

use App\VehicleApp\Vehicle\Main\Domain\Exception\DamageCoverage\DamageCoverageIsAttachedToDamage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;

class DamageCoverageDestroyer
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
     * @var DamageRepository
     */
    private  $damageRepository;

    /**
     * 
     *
     * @param DamageCoverageRepository $damageCoverageRepository
     * @param DamageRepository $damageRepository
     */
    public function __construct(DamageCoverageRepository $damageCoverageRepository, DamageRepository $damageRepository)
    {
        $this->damageCoverageRepository = $damageCoverageRepository;
        $this->damageRepository = $damageRepository;
    }

    /**
     * 
     *
     * @param DamageCoverage $damageCoverage
     * @return void
     */
    public function destroy(DamageCoverage $damageCoverage): void
    {

        $res = $this->damageRepository->countByCoverageDamageId($damageCoverage->getId());
        if ($res > 0) {
            throw new DamageCoverageIsAttachedToDamage();
        }
        $this->damageCoverageRepository->remove($damageCoverage);
    }
}
