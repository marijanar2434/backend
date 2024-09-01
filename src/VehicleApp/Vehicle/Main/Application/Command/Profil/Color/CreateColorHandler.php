<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Color;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\ColorValidator;

class CreateColorHandler implements CommandHandler
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
    private $colorValidator;

    public function __construct(ColorRepository $colorRepository, ColorValidator $colorValidator)
    {
        $this->colorRepository = $colorRepository;
        $this->colorValidator = $colorValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CreateColorCommand $command)
    {
        $color = new Color(
            new Id($command->getId()),
            $command->getName()
        );


        $notificationHandler = $this->colorValidator->validate($color);

        if ($notificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($notificationHandler);
        }

        $this->colorRepository->save($color);
    }
}
