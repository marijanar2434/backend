<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Transformer\Identity;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity\UserDto;

class UserItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param User $entity
     */
    public function write($entity): void
    {
        $this->data = new UserDto(
            $entity->getId()->getId(),
            $entity->getFullName(),
            $entity->getUsername(),
            $entity->getEmail(),
            $entity->getActive(),
            $entity->getAvatar()?->getFile(),
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
