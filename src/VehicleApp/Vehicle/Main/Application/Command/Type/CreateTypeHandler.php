<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Type;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Type\TypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\TypeValidator;

class CreateTypeHandler  implements CommandHandler
{

    private TypeRepository $typeRepository;

    private TypeValidator $typeValidator;

    
    private BrandRepository $brandRepository;


    public function __construct(
        TypeRepository $typeRepository,
        TypeValidator $typeValidator,
        BrandRepository $brandRepository
    ) {
        $this->typeRepository = $typeRepository;
        $this->typeValidator = $typeValidator;
        $this->brandRepository = $brandRepository;
    }

    public function __invoke(CreateTypeCommand $command)
    {

        /**
         * @var Brand|null
         */
        $brand = $this->brandRepository->findById(new Id($command->getBrandId()));


        if (empty($brand)) {
            throw new BrandNotFoundException();
        }

        /**
         * @var Type|null
         */
        $type = new Type(new Id($command->getId()), $command->getName(), $brand);


        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->typeValidator->validate($type);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->typeRepository->save($type);
    }
}
