<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Brand;

use App\VehicleApp\Vehicle\Main\Domain\Exception\Brand\BrandIsAttachedToTypes;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;

class BrandDestroyer
{

    /**
     * @var BrandRepository
     */
    private $brandRepository;


    /**
     * 
     *
     * @var TypeRepository
     */
    private  $typeRepository;

    /**
     * 
     *
     * @param BrandRepository $brandRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(BrandRepository $brandRepository, TypeRepository $typeRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->typeRepository = $typeRepository;
    }

    /**
     * 
     *
     * @param Brand $brand
     * @return void
     */
    public function destroy(Brand $brand): void
    {
        $res = $this->typeRepository->countByBrandId($brand->getId());

        if($res > 0){
            throw new BrandIsAttachedToTypes();
        }

        $this->brandRepository->remove($brand);
    }
}
