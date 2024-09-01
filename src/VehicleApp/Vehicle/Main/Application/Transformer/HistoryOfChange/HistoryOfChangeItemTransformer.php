<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\HistoryOfChange;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\HistoryOfChange\HistoryOfChangeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChange;

class HistoryOfChangeItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param HistoryOfChange $entity
     */

    public function write($entity): void
    {
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

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
