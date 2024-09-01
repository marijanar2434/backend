<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth;

use App\Common\Application\Bus\CommandBus;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Identity\PasswordResetUserCommand;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth\PasswordReset as PasswordResetModel;

class PasswordReset extends AbstractController
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
     * PasswordReset Constructor
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
     * @param PasswordResetModel $data
     * 
     * @return JsonResponse
     */
    public function __invoke(PasswordResetModel $data): JsonResponse
    {
        $this->validator->validate($data, ['groups' => ['password_reset']]);

        $this
            ->commandBus
            ->handle(new PasswordResetUserCommand(
                $data->passwordRequestId,
                $data->userId,
                $data->password
            ));

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
