<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Access;

interface AuthorizationStrategy
{
    /**
     * @param AuthorizationRequest $authorizationRequest
     * 
     * @return boolean
     */
    public function authorize(AuthorizationRequest $authorizationRequest): bool;
}
