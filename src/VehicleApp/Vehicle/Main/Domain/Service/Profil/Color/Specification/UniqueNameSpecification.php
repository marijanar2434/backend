<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Color\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var ColorRepository
     */
    private  $colorRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param ColorRepository $colorRepository
     */
    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    /**
     * @param Color $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $color = $this->colorRepository->findByName(
            $object->getName()
        );

        return $color === null || $object->getId()->equals($color->getId());
    }
}
