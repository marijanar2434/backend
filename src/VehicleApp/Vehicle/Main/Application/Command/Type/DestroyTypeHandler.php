<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Type;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Type\TypeIsAttachedToVehicleException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Type\TypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Type\TypeIsAttachedToVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Type\TypeDestroyer;

class DestroyTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var TypeRepository
     */
    private  $typeRepository;

    /**
     * 
     *
     * @var TypeDestroyer
     */
    private  $typeDestroyer;


    /**
     * 
     *
     * @param TypeRepository $typeRepository
     * @param TypeDestroyer $typeDestroyer
     */
    public function __construct(TypeRepository $typeRepository, TypeDestroyer $typeDestroyer)
    {
        $this->typeDestroyer = $typeDestroyer;
        $this->typeRepository = $typeRepository;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyTypeCommand $command)
    {


        /**
         * @var Type|null
         */
        $type = $this->typeRepository->findById(new Id($command->getId()));


        if (empty($type)) {
            throw new TypeNotFoundException();
        }

        try {   
            $this->typeDestroyer->destroy($type);
        } catch (TypeIsAttachedToVehicle) {
            throw new TypeIsAttachedToVehicleException();
        }
    }
}
