<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle;

use App\Common\Application\Bus\CommandBus;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\AttachUserToVehicleCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;

class AttachUser extends AbstractController
{
    /**
     * @var CommandBus
     */
    private  $commandBus;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * AttachRole Constructor
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
     * @param Vehicle $data
     * 
     * @return JsonResponse
     */
    public function __invoke(Vehicle $data): JsonResponse
    {
        
        $this->validator->validate($data, ['groups' => ['attach_user']]);

        $this->commandBus->handle(
            new AttachUserToVehicleCommand($data->id, $data->userId)
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
