<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Transformer\Identity;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity\UserAvatarDto;

class UserAvatarItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param string $entity
     */
    public function write($entity): void
    {
        $this->data = new UserAvatarDto(
            $entity
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
