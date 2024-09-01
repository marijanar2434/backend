<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle;


use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\UploadVehicleDocumentationCommand;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Vehicle\VehicleDocumentationDto;
use App\Common\Application\Bus\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\Common\Infrastructure\Delivery\Symfony\HttpFoundation\RequestFileMover;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Documentation;

class UploadDocumentation extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var RequestFileMover
     */
    private $requestFileMover;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * UploadImage Constructor
     *
     * @param CommandBus $commandBus
     * @param RequestFileMover $requestFileMover
     * @param ValidatorInterface $validator
     */
    public function __construct(CommandBus $commandBus, RequestFileMover $requestFileMover, ValidatorInterface $validator)
    {

        $this->commandBus = new ExceptionHandlingCommandBus($commandBus, new ExceptionHandler);
        $this->requestFileMover = $requestFileMover;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * 
     * @return Documentation
     */
    public function __invoke(Request $request): Documentation
    {
        $documentation = new Documentation();
        if ($request->files->count() > 0 && $request->files->get('file') !== null) {
            $documentation->file = $this->requestFileMover->move($request->files->get('file'));
        }

        $this->validator->validate($documentation, ['groups' => ['create']]);

        /**
         * @var VehicleDocumentationDto|null
         */
        $result = $this->commandBus
            ->handle(new UploadVehicleDocumentationCommand($documentation->file->getRealPath()))
            ?->last(HandledStamp::class)
            ?->getResult();

        $documentation->url = $result?->getUrl();


        return $documentation;
    }
}

