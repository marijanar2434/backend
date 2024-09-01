<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\FuelAndExpenseNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class UpdateFuelAndExpenseHandler implements CommandHandler
{

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private   $userRepository;

    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var FuelAndExpenseRepository
     */
    private $fuelAndExpenseRepository;


    public function __construct(UserVehicleRepository $userRepository, VehicleRepository $vehicleRepository, FuelAndExpenseRepository $fuelAndExpenseRepository)
    {
        $this->userRepository = $userRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
    }

    public function __invoke(UpdateFuelAndExpenseCommand $command)
    {

        /**
         * @var FuelAndExpense|null
         */
        $fuelAndExpense = $this->fuelAndExpenseRepository->findById(new Id($command->getId()));

        if (empty($fuelAndExpense)) {
            throw new FuelAndExpenseNotFoundException();
        }

        /**
         * @var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }



        if ($command->getUserId() != null) {
            /**
             * @var UserVehicle
             */
            $user = $this->userRepository->findByName($command->getUserId()) == null ? $this->userRepository->findById(new Id($command->getUserId()))  : $this->userRepository->findByName($command->getUserId());

            if ($user == null) {
                throw new UserNotFoundException();
            }
        } else {
            $user = null;
        }


        $fuelAndExpense->updateProperties(
            $command->getDate(),
            $command->getMileage(),
            $command->getExpense(),
            $command->getPrice(),
            $user,
            $command->getTimeOfUser(),
            $vehicle
        );


        $this->fuelAndExpenseRepository->save($fuelAndExpense);
    }
}
