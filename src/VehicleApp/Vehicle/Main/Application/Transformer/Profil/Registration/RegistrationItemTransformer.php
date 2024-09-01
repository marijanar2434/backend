<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Registration;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Registration\RegistrationDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;

class RegistrationItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Registration $entity
     */
    public function write($entity): void
    {

        $documentations = [];
        foreach ($entity->getDocumentations() as $doc) {
            $documentations[] = $doc->getFile()->getFile();
        }

        $this->data[] = new RegistrationDto(
            $entity->getId()->getId(),
            $entity->getRegistrationStartDate(),
            $entity->getRegistrationFee(),
            $entity->getUserVehicle()->getFullname(),
            $entity->getVehicle()->getType()->getName() . " " . $entity->getVehicle()->getType()->getBrand()->getName(),
            $entity->getTimeOfUser(),
            $entity->getRegistrationExpire(),
            $entity->getRegistrationNumber(),
            $documentations
        );
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
