<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Transformer\Auth;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationResponse;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Auth\AuthenticationResponseDto;

class AuthenticationItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param AuthenticationResponse $entity
     */
    public function write($entity): void
    {
        $this->data = new AuthenticationResponseDto(
            $entity->getSuccess(),
            $entity->getMessage(),
            $entity->getData(),
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
