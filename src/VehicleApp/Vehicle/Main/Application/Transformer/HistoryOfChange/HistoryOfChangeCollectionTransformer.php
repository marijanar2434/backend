<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\HistoryOfChange;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\HistoryOfChange\HistoryOfChangeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChange;

class HistoryOfChangeCollectionTransformer implements CollectionTransformer
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
         * @var HistoryOfChange $entity
         */
        foreach ($entities as $entity) {
            
            $changes = [];
            foreach ($entity->getChanges() as $change) {
                $changes[] = $change->getChange();
            }

            $this->data[] = new HistoryOfChangeDto(
                $entity->getId()->getId(),
                $entity->getUser(),
                $changes
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
