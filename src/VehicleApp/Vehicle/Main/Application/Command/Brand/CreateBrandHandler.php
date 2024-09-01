<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Brand;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\BrandValidator;

class CreateBrandHandler implements CommandHandler
{
    /**
     * 
     *
     * @var BrandRepository
     */
    private $brandRepository;


    private BrandValidator $brandValidator;

    public function __construct(BrandRepository $brandRepository, BrandValidator $brandValidator)
    {
        $this->brandRepository = $brandRepository;
        $this->brandValidator = $brandValidator;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CreateBrandCommand $command)
    {
        $brand = new Brand(
            new Id($command->getId()),
            $command->getName()
        );


        $notificationHandler = $this->brandValidator->validate($brand);

        if ($notificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($notificationHandler);
        }

        $this->brandRepository->save($brand);
    }
}
