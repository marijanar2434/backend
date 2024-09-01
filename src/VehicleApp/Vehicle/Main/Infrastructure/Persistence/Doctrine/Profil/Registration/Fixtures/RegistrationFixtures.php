<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Registration\Fixtures;


use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle\Fixtures\UserVehicleFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Fixtures\VehicleFixtures;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RegistrationFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var RegistrationRepository
     */
    private  $registrationRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param RegistrationRepository $registrationRepository
     * 
     */
    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            UserVehicleFixtures::class,
            VehicleFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $vehicles = $manager->getRepository(Vehicle::class)->findAll();
        $users = $manager->getRepository(UserVehicle::class)->findAll();

        foreach ($this->getRegistrations() as $registration) {

            $dateNow = new DateTimeImmutable();
            $dateNow = $dateNow->format("Y-m-d");

            $r =  new Registration(
                $registration['id'],
                $vehicles[$registration['vehicle']],
                $users[$registration['user']],
                $registration['registrationNumber'],
                $registration['registrationStartDate'],
                $registration['registrationFee'],
                $registration['timeOfUser'],

            );


            $regExp = $r->getRegistrationExpire()->format('Y-m-d');
            $regStart = $r->getRegistrationStartDate()->format('Y-m-d');


            if ($regStart <= $dateNow && $regExp > $dateNow) {
                $r->setActive(true);
            }

            $this->registrationRepository->save($r);
        }


        $manager->flush();
    }

    /**
     * @return array
     */
    private function getRegistrations(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    "vehicle" => 0,
                    "user" => 0,
                    "registrationFee" => "20540",
                    "registrationStartDate" => new DateTimeImmutable('2019-11-06'),
                    "registrationNumber" => "AR-1045-IJ",
                    "timeOfUser" => 120,
                ],
                [
                    'id' => new Id(),
                    "vehicle" => 0,
                    "user" => 5,
                    "registrationFee" => "30500",
                    "registrationStartDate" => new DateTimeImmutable('2020-12-25'),
                    "registrationNumber" => "BG-4021-PP",
                    "timeOfUser" => 90,
                ],
                [
                    'id' => new Id(),
                    "vehicle" => 3,
                    "user" => 4,
                    "registrationFee" => "40654",
                    "registrationStartDate" => new DateTimeImmutable('2022-01-07'),
                    "registrationNumber" => "NS-1414-IJ",
                    "timeOfUser" => 180,
                ],
                [
                    'id' => new Id(),
                    "vehicle" => 1,
                    "user" => 4,
                    "registrationFee" => "44040",
                    "registrationStartDate" => new DateTimeImmutable('2021-05-20'),
                    "registrationNumber" => "GM-1661-MH",
                    "timeOfUser" => 45,
                ]
            ];
    }
}
