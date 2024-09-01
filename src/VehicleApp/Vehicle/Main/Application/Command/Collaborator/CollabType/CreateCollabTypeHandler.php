<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\CollabType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\CollabTypeValidator;

class CreateCollabTypeHandler implements CommandHandler
{
    /**
     * 
     *
     * @var CollabTypeRepository
     */
    private  $collabTypeRepository;

    /**
     * 
     *
     * @var CollabTypeValidator
     */
    private  $collabTypeValidator;



    public function __construct(
        CollabTypeRepository $collabTypeRepository,
        CollabTypeValidator $collabTypeValidator
    ) {
        $this->collabTypeRepository = $collabTypeRepository;
        $this->collabTypeValidator = $collabTypeValidator;
    }

    public function __invoke(CreateCollabTypeCommand $command)
    {

        $collabType = new CollabType(
            new Id($command->getId()),
            $command->getName()
        );

        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->collabTypeValidator->validate($collabType);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->collabTypeRepository->save($collabType);
    }
}



