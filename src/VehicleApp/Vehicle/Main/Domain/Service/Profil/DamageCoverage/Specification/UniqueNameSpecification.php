<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\DamageCoverage\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var DamageCoverageRepository
     */
    private $damageCoverageRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param DamageCoverageRepository $damageCoverageRepository
     */
    public function __construct(DamageCoverageRepository $damageCoverageRepository)
    {
        $this->damageCoverageRepository = $damageCoverageRepository;
    }

    /**
     * @param  DamageCoverage$object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $damageCoverage = $this->damageCoverageRepository->findByName($object->getName());

        return $damageCoverage === null || $object->getId()->equals($damageCoverage->getId());
    }
}

