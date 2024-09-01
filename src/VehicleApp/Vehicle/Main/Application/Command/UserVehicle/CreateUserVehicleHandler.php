<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\UserVehicle;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class CreateUserVehicleHandler implements CommandHandler
{

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private  $userVehicleRepository;


    /**
     * 
     *
     * @param UserVehicleRepository $userVehicleRepository
     */
    public function __construct(UserVehicleRepository $userVehicleRepository)
    {
        $this->userVehicleRepository = $userVehicleRepository;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(CreateUserVehicleCommand $command)
    {


        /**
         * @var UserVehicle|null
         */
        $userVehicle = new UserVehicle(new Id($command->getId()), $command->getFullname(), 'dasdada', 'dasdsada');

        $this->userVehicleRepository->save($userVehicle);
    }
}
