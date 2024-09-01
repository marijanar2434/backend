<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Color;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorIsAttachedToVehiclesException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Color\ColorIsAttachedToVehicles;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Color\ColorDestroyer;

class DestroyColorHandler implements CommandHandler
{

    /**
     * 
     *
     * @var ColorRepository
     */
    private   $colorRepository;

    /**
     * 
     *
     * @var ColorDestroyer
     */
    private  $colorDestroyer;


    /**
     * 
     *
     * @param ColorRepository $colorRepository
     * @param ColorDestroyer $colorDestroyer
     */
    public function __construct(ColorRepository $colorRepository, ColorDestroyer $colorDestroyer)
    {

        $this->colorRepository = $colorRepository;
        $this->colorDestroyer = $colorDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyColorCommand $command)
    {

        /**
         * @var Color|null
         */
        $color = $this->colorRepository->findById(new Id($command->getId()));


        if (empty($color)) {
            throw new ColorNotFoundException();
        }

       try {     
            $this->colorDestroyer->destroy($color);
        } catch (ColorIsAttachedToVehicles) {
            throw new ColorIsAttachedToVehiclesException();
       } 
    }
}