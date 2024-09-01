<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Maintenance\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Maintenance\MaintenanceType\Fixtures\MaintenanceTypeFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\PartAndService\Fixtures\PartAndServiceFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle\Fixtures\UserVehicleFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Fixtures\VehicleFixtures;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MaintenanceFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var MaintenanceRepository
     */
    private  $maintenanceRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param MaintenanceRepository $maintenanceRepository
     * 
     */
    public function __construct(MaintenanceRepository $maintenanceRepository)
    {
        $this->maintenanceRepository = $maintenanceRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class,
            MaintenanceTypeFixtures::class,
            UserVehicleFixtures::class,
            PartAndServiceFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $vehicles = $manager->getRepository(Vehicle::class)->findAll();
        $maintenanceTypes = $manager->getRepository(MaintenanceType::class)->findAll();
        $users = $manager->getRepository(UserVehicle::class)->findAll();
        $parts = $manager->getRepository(PartAndService::class)->findAll();


        foreach ($this->getMaintenances() as $maintenance) {

            foreach ($maintenanceTypes as $mt) {
                if ($mt->getName() == $maintenance['maintenanceTypeName']) {
                    $maintenanceType = $mt;
                }
            }

            $partsArray = [];

           
            foreach($maintenance['parts'] as $key)
            {
                $partsArray[] = $parts[$key];
            }

            

            $mn =  new Maintenance(
                $maintenance['id'],
                empty($maintenanceType) ? null : $maintenanceType,
                $vehicles[$maintenance['vehicle']],
                $maintenance['date'],
                $maintenance['mileage'],
                $maintenance['fee'],
                empty($maintenance['timeOfUser']) ? null : $maintenance['timeOfUser'],
                empty($users[$maintenance['user']]) ? null : $users[$maintenance['user']],
                $partsArray
            );


            $this->maintenanceRepository->save($mn);
        }


        $manager->flush();
    }

    /**
     * @return array
     */
    private function getMaintenances(): array
    {

        return
            [
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2019-08-19'),
                    "mileage" => 143000,
                    "fee" => 18343,
                    "maintenanceTypeName" => "Regular",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 160,
                    "parts" => [0, 1]
                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-03-12'),
                    "mileage" => 153000,
                    "fee" => 19223,
                    "maintenanceTypeName" => "Regular",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 180,
                    "parts" => [2, 3]
                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-08-16'),
                    "mileage" => 156343,
                    "fee" =>56232,
                    "maintenanceTypeName" => "Not regular",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 320,
                    "parts" => [1, 3]
                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-08-28'),
                    "mileage" => 158232,
                    "fee" => 5624,
                    "maintenanceTypeName" => "Hygiene",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 60,
                    "parts" => [2]
                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-10-10'),
                    "mileage" => 161223,
                    "fee" => 2547,
                    "maintenanceTypeName" => "Tires",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 60,
                    "parts" => [2, 1]
                ],
                [
                    'id' => new Id(),
                    "date" => new DateTimeImmutable('2020-10-17'),
                    "mileage" => 163000,
                    "fee" => 17454,
                    "maintenanceTypeName" => "Regular",
                    "user" =>  0,
                    "vehicle" => 0,
                    "timeOfUser" => 120,
                    "parts" => [3, 2]
                ]
            ];
    }
}
