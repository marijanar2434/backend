<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Transformer\Access;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Access\RoleDto;

class RoleCollectionTransformer implements CollectionTransformer
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
         * @var Role $entity
         */
        foreach ($entities as $entity) {
            $this->data[] = new RoleDto(
                $entity->getId()->getId(),
                $entity->getName(),
                $entity->getIdentifier(),
                $entity->getActive(),
                $entity->getCreatedOn()->format(\DateTime::ATOM),
                $entity->getUpdatedOn()->format(\DateTime::ATOM)
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
