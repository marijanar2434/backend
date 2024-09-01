<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\Registration;

use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration\Documentation\DestroyRegDocumentationCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteRegDocumentation extends AbstractController
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
     * @param Registration $data
     * 
     * @return JsonResponse
     */
    public function __invoke(Registration $data): JsonResponse
    {
        $this->commandBus->handle(
            new DestroyRegDocumentationCommand($data->docId, $data->id)
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}


