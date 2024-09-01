<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseIsRequiredException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseType\ExpenseTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\ExpenseTypeValidator;

class CreateFuelAndExpenseHandler  implements CommandHandler
{
    /**
     * 
     *
     * @var FuelAndExpenseRepository
     */
    private   $fuelAndExpenseRepository;

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private  $userVehicleRepository;


    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var ExpenseTypeRepository
     */
    private  $expenseTypeRepository;

    public function __construct(
        FuelAndExpenseRepository $fuelAndExpenseRepository,
        UserVehicleRepository $userVehicleRepository,
        VehicleRepository $vehicleRepository,
        ExpenseTypeRepository $expenseTypeRepository
    ) {
        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
        $this->userVehicleRepository = $userVehicleRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->expenseTypeRepository = $expenseTypeRepository;
    }

    public function __invoke(CreateFuelAndExpenseCommand $command)
    {


        if ($command->getUserId() != null) {

            /**
             * @var UserVehicle
             */
            $user = $this->userVehicleRepository->findById(new Id($command->getUserId()));

            if ($user == null) {
                throw new UserNotFoundException();
            }

        } else {
            $user = null;
        }



        /**
         * @var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));
        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }

        /**
         * @var ExpenseType
         */
        $expenseType = $this->expenseTypeRepository->findById(new Id($command->getExpenseTypeId()));

        if ($expenseType == null) {
            throw new ExpenseTypeNotFoundException();
        }

        if($expenseType->getName() == "Fuel" && $command->getExpense() <= 0)
        {
            throw new ExpenseIsRequiredException();
        }

    
        $fuelAndExpense = new FuelAndExpense(
            new Id($command->getId()),
            $command->getDate(),
            $command->getMileage(),
            $command->getPrice(),
            $vehicle,
            $expenseType,
            $command->getExpense(),
            $user,
            $command->getTimeOfUser()
        );


        $this->fuelAndExpenseRepository->save($fuelAndExpense);
    }
}
