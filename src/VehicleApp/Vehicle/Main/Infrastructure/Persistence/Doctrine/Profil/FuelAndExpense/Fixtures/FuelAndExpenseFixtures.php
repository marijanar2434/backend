<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\FuelAndExpense\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\FuelAndExpense\ExpenseType\Fixtures\ExpenseTypeFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle\Fixtures\UserVehicleFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Fixtures\VehicleFixtures;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FuelAndExpenseFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var FuelAndExpenseRepository
     */
    private  $fuelAndExpenseRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param FuelAndExpenseRepository $fuelAndExpenseRepository
     * 
     */
    public function __construct(FuelAndExpenseRepository $fuelAndExpenseRepository)
    {
        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class,
            ExpenseTypeFixtures::class,
            UserVehicleFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $vehicles = $manager->getRepository(Vehicle::class)->findAll();
        $expenseTypes = $manager->getRepository(ExpenseType::class)->findAll();
        $users = $manager->getRepository(UserVehicle::class)->findAll();

        foreach ($this->getFuelAndExpenses() as $fuelAndExpense) {
            foreach ($expenseTypes as $exp) {
                if ($exp->getName() == $fuelAndExpense['expenseTypeName']) {
                    $expenseType = $exp;
                }
            }

            $fxp =  new FuelAndExpense(
                $fuelAndExpense['id'],
                $fuelAndExpense['date'],
                $fuelAndExpense['mileage'],
                $fuelAndExpense['price'],
                $vehicles[$fuelAndExpense['vehicle']],
                empty($expenseType) ? null : $expenseType,
                $fuelAndExpense['expense'],
                empty($users[$fuelAndExpense['user']]) ? null : $users[$fuelAndExpense['user']],
                empty($fuelAndExpense['timeOfUser']) ? null : $fuelAndExpense['timeOfUser']
            );


            $this->fuelAndExpenseRepository->save($fxp);
        }


        $manager->flush();
    }

    /**
     * @return array
     */
    private function getFuelAndExpenses(): array
    {

        return
            [
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-08-14'),
                    "mileage" => 143000,
                    "expense" => 33.13,
                    "price" => 142.52,
                    "expenseTypeName" => "Fuel",
                    "user" =>  null,
                    "vehicle" => 0,
                    "timeOfUser" => null

                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-08-28'),
                    "mileage" => 144222,
                    "expense" => 40.23,
                    "price" => 144.23,
                    "expenseTypeName" => "Fuel",
                    "user" =>  null,
                    "vehicle" => 0,
                    "timeOfUser" => null

                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-08-30'),
                    "mileage" => 145443,
                    "expense" => 100,
                    "price" => 2500,
                    "expenseTypeName" => "Tag",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 60

                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-09-28'),
                    "mileage" => 145443,
                    "expense" => 20.25,
                    "price" => 360,
                    "expenseTypeName" => "Wash",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 30

                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-09-28'),
                    "mileage" => 146123,
                    "expense" => 35.53,
                    "price" => 145.23,
                    "expenseTypeName" => "Fuel",
                    "user" =>  null,
                    "vehicle" => 0,
                    "timeOfUser" => null

                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-09-28'),
                    "mileage" => 147565,
                    "expense" => 38.46,
                    "price" => 146.01,
                    "expenseTypeName" => "Fuel",
                    "user" =>  null,
                    "vehicle" => 0,
                    "timeOfUser" => null

                ],
            ];
    }
}
