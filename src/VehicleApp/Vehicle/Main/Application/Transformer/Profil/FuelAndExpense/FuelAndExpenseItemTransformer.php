<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\FuelAndExpense;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\FuelAndExpenseDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;

class FuelAndExpenseItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param FuelAndExpense $entity
     */
    public function write($entity): void
    {

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

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
