<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Vehicle;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Vehicle\VehicleDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;

class VehicleCollectionTransformer implements CollectionTransformer
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
         * @var Vehicle $entity
         */
        foreach ($entities as $entity) {

            $documentations = [];

            foreach ($entity->getDocumentations() as $doc) {
                $documentations[] = $doc->getFile()->getFile();
            }

            $users = [];

            foreach ($entity->getUsers() as $u) {
                $users[] = ($u->getFullname());
            }

            $images = [];

            foreach ($entity->getImages() as $image) {
                $images[] = $image->getImage()->getFile();
            }


            $this->data[] = new VehicleDto(
                $entity->getId()->getId(),
                $entity->getType()->getName(),
                $entity->getType()->getBrand()->getName(),
                $entity->getColor()->getName(),
                $entity->getPrice(),
                $entity->getEngineNumber(),
                $entity->getChassisNumber(),
                $entity->getYearOfProduction(),
                $entity->getVehicleActiveTo(),
                $entity->getVehicleActiveFrom(),
                count($entity->getUsers()) > 0 ? 'Employee' : 'Not employee',
                $users,
                $images,
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
