<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth;

use App\Common\Application\Bus\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Identity\RequestPasswordResetUserCommand;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth\RequestPasswordReset as RequestPasswordResetModel;

class RequestPasswordReset extends AbstractController
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
     * RequestPasswordReset Constructor
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
     * @param RequestPasswordResetModel $data
     * 
     * @return JsonResponse
     */
    public function __invoke(RequestPasswordResetModel $data): JsonResponse
    {
        $this->validator->validate($data, ['groups' => ['request_password_reset']]);

        $this->commandBus
            ->handle(new RequestPasswordResetUserCommand($data->email));

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
