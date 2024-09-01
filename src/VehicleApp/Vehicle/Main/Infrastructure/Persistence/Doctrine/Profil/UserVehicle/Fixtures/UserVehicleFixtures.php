<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Identity\Fixtures\UserFixtures;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Fixtures\VehicleFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserVehicleFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var UserVehicleRepository
     */
    private $userVehicleRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param UserVehicleRepository $userVehicleRepository
     * 
     */
    public function __construct(UserVehicleRepository $userVehicleRepository)
    {
        $this->userVehicleRepository = $userVehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            VehicleFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
       
        $users = $manager->getRepository(User::class)->findAll();
       
        foreach ($users as $user) {
            $u =  new UserVehicle(
                new Id(),
                $user->getFullname(),
                $user->getUsername(),
                $user->getEmail()
            );
           
            $this->userVehicleRepository->save($u);
        }
        $manager->flush();
    }
}
