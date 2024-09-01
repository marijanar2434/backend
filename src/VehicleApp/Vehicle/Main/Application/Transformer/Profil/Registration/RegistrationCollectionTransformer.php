<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Registration;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Registration\RegistrationDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;

class RegistrationCollectionTransformer implements CollectionTransformer
{
    /**
     * @var mixed
     */
    private $data = [];

    /**
     * @inheritDoc
     */
    public function write($entities): void
    {
        $this->data = [];

        
        /**
         * @var Registration $entity
         */
        foreach ($entities as $entity) {
          
            $documentations = [];
            foreach($entity->getDocumentations() as $doc)
            {
                $documentations[] = $doc->getFile()->getFile();
            }

           
            $this->data[] = new RegistrationDto(
                $entity->getId()->getId(),
                $entity->getRegistrationStartDate(),
                $entity->getRegistrationFee(),
                $entity->getUserVehicle()->getFullname(),
                $entity->getVehicle()->getType()->getName(). " ". $entity->getVehicle()->getType()->getBrand()->getName(),
                $entity->getTimeOfUser(),
                $entity->getRegistrationExpire(),
                $entity->getRegistrationNumber(),
                $documentations
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}

