<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle;

use App\Common\Application\Bus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation\DestroyVehicleDocumentationCommand;

class DeleteDocumentation extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;


    /**
     * DetachRole Constructor
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = new ExceptionHandlingCommandBus($commandBus, new ExceptionHandler);
    }

    /**
     * @param Vehicle $data
     * 
     * @return JsonResponse
     */
    public function __invoke(Vehicle $data): JsonResponse
    {
        $this->commandBus->handle(
            new DestroyVehicleDocumentationCommand($data->docId, $data->id)
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}

