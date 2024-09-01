<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Color\Fixtures\ColorFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle\Fixtures\UserVehicleFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Type\Fixtures\TypeFixtures;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var VehicleRepository
     */
    private $vehicleRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param VehicleRepository $vehicleRepository
     * 
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            ColorFixtures::class,
            TypeFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $colors = $manager->getRepository(Color::class)->findAll();
        $types = $manager->getRepository(Type::class)->findAll();
        
       

        foreach ($this->getVehicles() as $vehicle) {
           
            $randomType = rand(0, count($types)-1);
            $randomColor = rand(0, count($colors)-1); 
         
            
            $v =  new Vehicle(
                $vehicle['id'],
                $types[$randomType],
                $vehicle['price'],
                $colors[$randomColor],
                $vehicle['engineNumber'],
                $vehicle['chassisNumber'],
                $vehicle['yearOfProduction'],
                $vehicle['vehicleActiveFrom'],
                empty($vehicle['vehicleActiveTo']) ? null : $vehicle['vehicleActiveTo']
            );
            
           

          
            $this->vehicleRepository->save($v);
        }


        $manager->flush();
    }

    /**
     * @return array
     */
    private function getVehicles(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    "price" => 20200130,
                    "engineNumber" => "SDA021312332N",
                    "chassisNumber" => "28103373N",
                    "yearOfProduction" => "2019",
                    "vehicleActiveFrom" =>  new DateTimeImmutable('2017-10-05')

                ],
                [
                    'id' => new Id(),
                    "price" => 9150100,
                    "engineNumber" => "WAUZZZ4BZWN049087",
                    "chassisNumber" => "OASDJOASDDASDLASDKL",
                    "yearOfProduction" => "2014",
                    "vehicleActiveFrom" =>  new DateTimeImmutable('2019-10-05'),
                    "vehicleActiveTo" => new DateTimeImmutable('2022-10-15')
                ],
                [
                    'id' => new Id(),
                    "price" => 5650720,
                    "engineNumber" => "WAUYSZZ3DSWN04SD39",
                    "chassisNumber" => "OASM90PASKDPASDAS0D90213",
                    "yearOfProduction" => "2011",
                    "vehicleActiveFrom" =>  new DateTimeImmutable('2019-10-05'),
                    "vehicleActiveTo" => new DateTimeImmutable('2021-10-15')
                ],
                [
                    'id' => new Id(),
                    "price" => 22950830,
                    "engineNumber" => "WVWZZZ1JZ3W386752",
                    "chassisNumber" => "ODHJSOJOASJASDASDPOASJADSOAS",
                    "yearOfProduction" => "2022",
                    "vehicleActiveFrom" =>  new DateTimeImmutable('2022-06-02')
                ],
                [
                    'id' => new Id(),
                    "price" => 14250130,
                    "engineNumber" => "WVGPDS8SP4S5SDZ52",
                    "chassisNumber" => "ASDPOASDPOASJUDASDDA1231LJASD",
                    "yearOfProduction" => "2020",
                    "vehicleActiveFrom" =>  new DateTimeImmutable('2021-05-05')
                ]
            ];
    }
}
