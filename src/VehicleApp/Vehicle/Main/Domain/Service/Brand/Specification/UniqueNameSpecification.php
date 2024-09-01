<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Brand\Specification;

use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var BrandRepository
     */
    private $brandRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param Brand $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $brand = $this->brandRepository->findByName(
            $object->getName()
        );

        return $brand === null || $object->getId()->equals($brand->getId());
    }
}
