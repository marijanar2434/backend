<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\FuelAndExpense;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\FuelAndExpenseDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;

class FuelAndExpenseCollectionTransformer implements CollectionTransformer
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
         * @var FuelAndExpense $entity
         */
        foreach ($entities as $entity) {
            $this->data[] = new FuelAndExpenseDto(
                
                $entity->getId()->getId(),
                $entity->getDate(),
                $entity->getMileage(),
                $entity->getExpense(),
                $entity->getPrice(),
                $entity->getUser() == null ? null : $entity->getUser()->getFullname(),
                $entity->getTimeOfUser(),
                $entity->getVehicle()->getId(),
                $entity->getExpenseType()->getName()
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
