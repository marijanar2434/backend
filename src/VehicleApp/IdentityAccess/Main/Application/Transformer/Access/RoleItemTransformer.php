<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Transformer\Access;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Access\RoleDto;

class RoleItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Role $entity
     */
    public function write($entity): void
    {
        $this->data = new RoleDto(
            $entity->getId()->getId(),
            $entity->getName(),
            $entity->getIdentifier(),
            $entity->getActive(),
            $entity->getCreatedOn()->format(\DateTime::ATOM),
            $entity->getUpdatedOn()->format(\DateTime::ATOM)
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
