<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\PartAndService\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param PartAndServiceRepository $partAndServiceRepository
     */
    public function __construct(PartAndServiceRepository $partAndServiceRepository)
    {
        $this->partAndServiceRepository = $partAndServiceRepository;
    }

    /**
     * @param  PartAndService$object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $partAndService = $this->partAndServiceRepository->findByName($object->getName());

        return $partAndService === null || $object->getId()->equals($partAndService->getId());
    }
}
