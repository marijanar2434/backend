<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Brand;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\BrandValidator;

class UpdateBrandHandler implements CommandHandler
{

    /**
     * 
     *
     * @var BrandRepository
     */
    private $brandRepository;


    /**
     * 
     *
     * @var BrandValidator
     */
    private $brandValidator;


    public function __construct(BrandRepository $brandRepository, BrandValidator $brandValidator)
    {
        $this->brandRepository = $brandRepository;
        $this->brandValidator = $brandValidator;
    }

    public function __invoke(UpdateBrandCommand $command)
    {

        /**
         * @var Brand|null
         */
        $brand = $this->brandRepository->findById(new Id($command->getId()));


        if (empty($brand)) {
            throw new BrandNotFoundException();
        }


        $brand->updateProperties(!empty($command->getName()) ? $command->getName() : $brand->getName());

        $validationNotificationHandler = $this->brandValidator->validate($brand);

        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->brandRepository->save($brand);
    }
}
