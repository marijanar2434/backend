<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\DamageCoverage\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DamageCoverageFixtures extends Fixture
{
    /**
     * @var DamageCoverageRepository
     */
    private  $damageCoverageRepository;


    /**
     * UserFixtures Constructor
     *
     * @param DamageCoverageRepository $damageCoverageRepository
     *
     */
    public function __construct(DamageCoverageRepository $damageCoverageRepository)
    {
        $this->damageCoverageRepository = $damageCoverageRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getDamageCoverage() as $dc) {
            $damage = new DamageCoverage(
                $dc['id'],
                $dc['name']
            );

            $this->damageCoverageRepository->save($damage);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getDamageCoverage(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'Employee'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Other persons'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Insurance'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Company'
                ]
            ];
    }
}
