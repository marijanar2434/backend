<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Damage;

use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;

class DamageDestroyer
{
    /**
     * 
     *
     * @var DamageRepository
     */
    private $damageRepository;

    /**
     * @param DamageRepository $damageRepository
     */
    public function __construct(DamageRepository $damageRepository)
    {
        $this->damageRepository = $damageRepository;
    }

    /**
     * 
     *
     * @param Damage $damage
     * @return void
     */
    public function destroy(Damage $damage): void
    {
        $this->damageRepository->remove($damage);
    }
}
