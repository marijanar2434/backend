<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Auth;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\Authentication;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Auth\UserAuthFailedException;

class AuthenticateUserHandler implements CommandHandler
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var ItemTransformer
     */
    private $itemTransformer;

    /**
     * AuthenticateUserHandler Constructor
     *
     * @param Authentication $authentication
     */
    public function __construct(Authentication $authentication, ItemTransformer $itemTransformer)
    {
        $this->authentication = $authentication;
        $this->itemTransformer = $itemTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(AuthenticateUserCommand $command)
    {
        $authenticationResponse = $this->authentication->authenticate(
            $command->getIdentity(),
            $command->getPassword()
        );

        if (!$authenticationResponse->getSuccess()) {
            throw new UserAuthFailedException(
                $authenticationResponse->getMessage()
            );
        }

        $this->itemTransformer->write($authenticationResponse);
        return $this->itemTransformer->read();
    }
}
