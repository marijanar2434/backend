<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Identity\Fixtures;

use Faker\Factory;
use Faker\Generator;
use App\Common\Domain\ValueObject\Id;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Common\Infrastructure\Service\Hasher\Hasher;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Access\Fixtures\RoleFixtures;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth\Fixtures\ClientFixtures;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * UserFixtures Constructor
     *
     * @param UserRepository $userRepository
     * @param Hasher $hasher
     */
    public function __construct(UserRepository $userRepository, Hasher $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
        $this->faker = Factory::create();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            RoleFixtures::class,
            ClientFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getUsers() as $user) {
            $u = new User(
                $user['id'],
                $user['fullName'],
                $user['username'],
                $user['email'],
                $this->hasher->hash($user['password']),
                $user['active']
            );

            match ($user['username']) {
                'system' => $u->attachRole($this->getReference('ROLE_SYSTEM')),
                'admin' => $u->attachRole($this->getReference('ROLE_ADMINISTRATOR')),
                default => true
            };

            $this->userRepository->save($u);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getUsers(): array
    {
        $users = [
            [
                'id' => new Id('e4e9aeca-3858-4629-9f06-d2c2654633c9'),
                'fullName' => 'System',
                'username' => 'system',
                'email' => 'system@dev-vehicle.com',
                'password' => 'systemSystem321',
                'active' => true,
            ],
            [
                'id' => new Id(),
                'fullName' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@dev-vehicle.com',
                'password' => 'admin123',
                'active' => true,
            ]
        ];

        for ($i = 0; $i < 30; $i++) {
            $users[] = [
                'id' => new Id(),
                'fullName' => $this->faker->name(),
                'username' => $this->faker->userName(),
                'email' => $this->faker->email(),
                'password' => 'pass123',
                'active' => rand(0, 1) == 1,
            ];
        }

        return $users;
    }
}
