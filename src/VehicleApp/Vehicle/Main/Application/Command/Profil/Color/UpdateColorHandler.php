<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Color;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\ColorValidator;

class UpdateColorHandler implements CommandHandler
{

    /**
     * 
     *
     * @var ColorRepository
     */
    private $colorRepository;


    /**
     * 
     *
     * @var ColorValidator
     */
    private  $colorValidator;


    public function __construct(ColorRepository $colorRepository, ColorValidator $colorValidator)
    {
        $this->colorRepository = $colorRepository;
        $this->colorValidator = $colorValidator;
    }

    public function __invoke(UpdateColorCommand $command)
    {

        /**
         * @var Color|null
         */
        $color = $this->colorRepository->findById(new Id($command->getId()));


        if (empty($color)) {
            throw new ColorNotFoundException();
        }

        $color->updateProperties(
            !empty($command->getName()) ? $command->getName() : $color->getName()
        );


        $validationNotificationHandler = $this->colorValidator->validate($color);

        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->colorRepository->save($color);
    }
}
