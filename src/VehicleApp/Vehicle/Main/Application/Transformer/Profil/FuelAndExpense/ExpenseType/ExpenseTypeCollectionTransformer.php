<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\ExpenseType\ExpenseTypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;

class ExpenseTypeCollectionTransformer implements CollectionTransformer
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
         * @var ExpenseType $entity
         */
        foreach ($entities as $entity) {
           
            $this->data[] = new ExpenseTypeDto(
                $entity->getId()->getId(),
                $entity->getName()
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