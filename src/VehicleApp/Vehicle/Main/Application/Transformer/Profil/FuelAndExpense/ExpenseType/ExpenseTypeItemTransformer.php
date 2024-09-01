<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\ExpenseType\ExpenseTypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;

class ExpenseTypeItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param ExpenseType $entity
     */
    public function write($entity): void
    {

        $this->data[] = new ExpenseTypeDto(
            $entity->getId()->getId(),
            $entity->getName()
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

