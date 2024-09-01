<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\DamageCoverage\Specification\UniqueNameSpecification;

class DamageCoverageValidator extends Validator
{
    /**
     * @var DamageCoverageRepository
     */ 
    private $damageCoverageRepository;

    /**
     * BrandValidator Constructor
     *
     * @param DamageCoverageRepository $damageCoverageRepository
     */
    public function __construct(DamageCoverageRepository $damageCoverageRepository)
    {
        $this->damageCoverageRepository = $damageCoverageRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Damage coverage with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(DamageCoverage $damageCoverage): bool
    {
        return (new UniqueNameSpecification($this->damageCoverageRepository))->isSatisfiedBy($damageCoverage);
    }
}

