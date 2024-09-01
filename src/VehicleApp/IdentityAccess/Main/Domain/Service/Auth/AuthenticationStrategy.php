<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth;

use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationResponse;

interface AuthenticationStrategy
{
    /**
     * @param AuthenticationRequest $authenticationRequest
     * 
     * @return AuthenticationResponse
     */
    public function authenticate(AuthenticationRequest $authenticationRequest): AuthenticationResponse;
}
