<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Brand;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandIsAttachedToTypesException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Brand\BrandIsAttachedToTypes;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Brand\BrandDestroyer;

class DestroyBrandHandler implements CommandHandler
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
     * @var BrandDestroyer
     */
    private $brandDestroyer;


    /**
     * 
     *
     * @param BrandRepository $brandRepository
     * @param BrandDestroyer $brandDestroyer
     */
    public function __construct(BrandRepository $brandRepository, BrandDestroyer $brandDestroyer)
    {

        $this->brandRepository = $brandRepository;
        $this->brandDestroyer = $brandDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyBrandCommand $command)
    {

        /**
         * @var Brand|null
         */
        $brand = $this->brandRepository->findById(new Id($command->getId()));


        if (empty($brand)) {
            throw new BrandNotFoundException();
        }

        try {     
            $this->brandDestroyer->destroy($brand);
        } catch (BrandIsAttachedToTypes) {
            throw new BrandIsAttachedToTypesException();
        }
    }
}
