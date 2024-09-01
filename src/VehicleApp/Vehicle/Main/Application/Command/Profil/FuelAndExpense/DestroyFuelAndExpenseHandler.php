<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\FuelAndExpenseNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\FuelAndExpense\FuelAndExpenseDestroyer;

class DestroyFuelAndExpenseHandler implements CommandHandler
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
     * @var FuelAndExpenseDestroyer
     */
    private   $fuelAndExpenseDestroyer;


    /**
     * 
     *
     * @param FuelAndExpenseRepository $fuelAndExpenseRepository
     * @param FuelAndExpenseDestroyer $fuelAndExpenseDestroyer
     */
    public function __construct(FuelAndExpenseRepository $fuelAndExpenseRepository, FuelAndExpenseDestroyer $fuelAndExpenseDestroyer)
    {
        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
        $this->fuelAndExpenseDestroyer = $fuelAndExpenseDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyFuelAndExpenseCommand $command)
    {

     
        /**
         * @var FuelAndExpense|null
         */
        
        $fuelandExpense = $this->fuelAndExpenseRepository->findById(new Id($command->getId()));

        if (empty($fuelandExpense)) {
            throw new FuelAndExpenseNotFoundException();
        }

        
        $this->fuelAndExpenseDestroyer->destroy($fuelandExpense);


    }
}


