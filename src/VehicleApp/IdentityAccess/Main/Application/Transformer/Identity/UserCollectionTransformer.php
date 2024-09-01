<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Transformer\Identity;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity\UserDto;

class UserCollectionTransformer implements CollectionTransformer
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
         * @var User $entity
         */
        foreach ($entities as $entity) {
            $this->data[] = new UserDto(
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
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
