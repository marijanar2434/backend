<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\User;

use App\Common\Application\Bus\CommandBus;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Access\DetachRoleFromUserCommand;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\User\User;

class DetachRole extends AbstractController
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
     * DetachRole Constructor
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
     * @param User $data
     * 
     * @return JsonResponse
     */
    public function __invoke(User $data): JsonResponse
    {
        $this->validator->validate($data, ['groups' => ['detach_role']]);

        $this->commandBus->handle(
            new DetachRoleFromUserCommand($data->id, $data->roleId)
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
