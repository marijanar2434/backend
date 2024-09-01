<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Type;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Type\TypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\TypeValidator;

class UpdateTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var TypeRepository
     */
    private  $typeRepository;

    /**
     * 
     *
     * @var TypeValidator
     */
    private  $typeValidator;

    /**
     * 
     *
     * @var BrandRepository
     */
    private BrandRepository $brandRepository;


    public function __construct(TypeRepository $typeRepository, TypeValidator $typeValidator, BrandRepository $brandRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->typeValidator = $typeValidator;
        $this->brandRepository = $brandRepository;
    }

    public function __invoke(UpdateTypeCommand $command)
    {

        /**
         * @var Type|null
         */
        $type = $this->typeRepository->findById(new Id($command->getId()));

        if (empty($type)) {
            throw new TypeNotFoundException();
        }


        /**
         * @var Brand|null
         */
        $brand = $this->brandRepository->findByName($command->getBrandId()) == null ? $this->brandRepository->findById(new Id($command->getBrandId()))  : $this->brandRepository->findByName($command->getBrandId());

        if (empty($brand)) {
            throw new BrandNotFoundException();
        }

        $type->updateProperties(
            !empty($command->getName()) ? $command->getName() : $type->getName(),
            $brand
        );


        $validationNotificationHandler = $this->typeValidator->validate($type);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->typeRepository->save($type);
    }
}
