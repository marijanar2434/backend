<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle;

use App\Common\Application\Bus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\Filter\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image\CreateImageVehicleCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Image;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Vehicle;

class CreateImage extends AbstractController
{
    /**
     * @var CommandBus
     */
    private  $commandBus;


    /**
     * AttachRole Constructor
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
            new CreateImageVehicleCommand($data->id, $data->url)
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
