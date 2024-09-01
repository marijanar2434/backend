<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Damage\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\DamageCoverage\Fixtures\DamageCoverageFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\PartAndService\Fixtures\PartAndServiceFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle\Fixtures\UserVehicleFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Fixtures\VehicleFixtures;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DamageFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var DamageRepository
     */
    private $damageRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param DamageRepository $damageRepository
     * 
     */
    public function __construct(DamageRepository $damageRepository)
    {
        $this->damageRepository = $damageRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class,
            DamageCoverageFixtures::class,
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
        $damageCoverages = $manager->getRepository(DamageCoverage::class)->findAll();
        $users = $manager->getRepository(UserVehicle::class)->findAll();
        $parts = $manager->getRepository(PartAndService::class)->findAll();


        foreach ($this->getDamages() as $damage) {

            foreach ($damageCoverages as $dc) {
                if ($dc->getName() == $damage['damageCoverage']) {
                    $damageCoverage = $dc;
                }
            }

            $partsArray = [];


            foreach($parts as $part)
            {   
                if(in_array($part->getName(),$damage['parts'],true))
                {
                    $partsArray[] = $part;
                }
               
            }

            

            $dcoverage =  new Damage(
                $damage['id'],
                $damage['description'],
                empty( $damageCoverage) ? null :  $damageCoverage,
                $damage['date'],
                $damage['fee'],
                $vehicles[$damage['vehicle']],
                empty($users[$damage['user']]) ? null : $users[$damage['user']],
                empty($damage['timeOfUser']) ? null : $damage['timeOfUser'],
                $partsArray
            );


            $this->damageRepository->save($dcoverage);
        }


        $manager->flush();
    }

    /**
     * @return array
     */
    private function getDamages(): array
    {

        return
            [
                [
                    'id' => new Id(),
                    "description" => "Damaged left wing and bumper",
                    "date" => new DateTimeImmutable('2019-08-19'),
                    "fee" => 18343,
                    "damageCoverage" => "Company",
                    "user" =>  1,
                    "vehicle" => 0,
                    "timeOfUser" => 100,
                    "parts" => ["Parts replacement", "Painting"]
                ],
                [
                    'id' => new Id(),
                    "description" => "Damaged left rearview mirror and door",
                    "date" => new DateTimeImmutable('2020-05-20'),
                    "fee" => 5600,
                    "damageCoverage" => "Employee",
                    "user" => null,
                    "vehicle" => 0,
                    "timeOfUser" => null,
                    "parts" => ["Parts replacement", "Painting"]
                ],
                [
                    'id' => new Id(),
                    "description" => "Damaged  left wheel, wing and door",
                    "date" => new DateTimeImmutable('2021-04-04'),
                    "fee" => 20600,
                    "damageCoverage" => "Insurance",
                    "user" =>  3,
                    "vehicle" => 0,
                    "timeOfUser" => 180,
                    "parts" => ["Parts replacement"]
                ]
            ];
    }
}
