<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Access\Fixtures;

use App\Common\Domain\ValueObject\Id;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth\Fixtures\ClientFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RoleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleFixtures Constructor
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            ClientFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getRoles() as $role) {
            $r = new Role(
                $role['id'],
                $role['name'],
                $role['identifier'],
                $role['active']
            );

            $this->roleRepository->save($r);

            $this->addReference($role['identifier'], $r);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getRoles(): array
    {
        return [
            [
                'id' => new Id(),
                'name' => 'User',
                'identifier' => 'ROLE_USER',
                'active' => true
            ],
            [
                'id' => new Id(),
                'name' => 'Administrator',
                'identifier' => 'ROLE_ADMINISTRATOR',
                'active' => true
            ],
            [
                'id' => new Id(),
                'name' => 'System',
                'identifier' => 'ROLE_SYSTEM',
                'active' => true
            ]
        ];
    }
}
