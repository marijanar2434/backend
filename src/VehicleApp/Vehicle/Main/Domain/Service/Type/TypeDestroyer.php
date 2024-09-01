<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Type;

use App\VehicleApp\Vehicle\Main\Domain\Exception\Type\TypeIsAttachedToVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;

class TypeDestroyer
{
    /**
     * @var TypeRepository
     */
    private  $typeRepository;


    /**
     * 
     *
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    /**
     * @param TypeRepository $typeRepository
     */
    public function __construct(TypeRepository $typeRepository, VehicleRepository $vehicleRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * 
     *
     * @param Type $type
     * @return void
     */
    public function destroy(Type $type): void
    {

        $res = $this->vehicleRepository->countByTypeId($type->getId());
        if ($res > 0) {
            throw new TypeIsAttachedToVehicle();
        }


        $this->typeRepository->remove($type);
    }
}
