<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth;

use App\Common\Shared\Array\Arr;
use App\Common\Application\Bus\CommandBus;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Auth\AuthenticationResponseDto;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Auth\AuthenticateUserCommand;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth\AccessToken as AccessTokenModel;

class AccessToken extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * AccessToken Constructor
     *
     * @param CommandBus $commandBus
     * @param ValidatorInterface $validator
     */
    public function __construct(CommandBus $commandBus, ValidatorInterface $validator)
    {
        $this->commandBus = new ExceptionHandlingCommandBus($commandBus, new ExceptionHandler);
        $this->validator = $validator;
    }

    /**
     * @param AccessTokenModel $data
     * 
     * @return JsonResponse|AccessTokenModel
     */
    public function __invoke(AccessTokenModel $data): JsonResponse|AccessTokenModel
    {
        $this->validator->validate($data, ['groups' => ['access_token']]);

        /**
         * @var AuthenticationResponseDto|null
         */
        $result = $this->commandBus
            ->handle(new AuthenticateUserCommand($data->username, $data->password))
            ?->last(HandledStamp::class)
            ?->getResult();

        if ($result?->getSuccess()) {
            $data->tokenType = Arr::get($result->getData(), 'tokenType');
            $data->expiresIn = Arr::get($result->getData(), 'expiresIn');
            $data->accessToken = Arr::get($result->getData(), 'accessToken');
            $data->refreshToken = Arr::get($result->getData(), 'refreshToken');
        }

        return $data;
    }
}
