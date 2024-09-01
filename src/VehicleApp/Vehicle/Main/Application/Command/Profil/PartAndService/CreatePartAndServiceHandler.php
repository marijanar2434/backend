<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\PartAndService;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\PartAndServiceValidator;

class CreatePartAndServiceHandler implements CommandHandler
{
    /**
     * 
     *
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;

    /**
     * 
     *
     * @var PartAndServiceValidator
     */
    private  $partAndServiceValidator;



    public function __construct(
        PartAndServiceRepository $partAndServiceRepository,
        PartAndServiceValidator $partAndServiceValidator
    ) {
        $this->partAndServiceRepository = $partAndServiceRepository;
        $this->partAndServiceValidator = $partAndServiceValidator;
    }

    public function __invoke(CreatePartAndServiceCommand $command)
    {

        $partAndService = new PartAndService(
            new Id($command->getId()),
            $command->getName()
        );

        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->partAndServiceValidator->validate($partAndService);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }


        $this->partAndServiceRepository->save($partAndService);
    }
}

