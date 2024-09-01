<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Maintenance\MaintenanceType\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MaintenanceTypeFixtures extends Fixture
{
    /**
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;


    /**
     * UserFixtures Constructor
     *
     * @param MaintenanceTypeRepository $maintenanceTypeRepository
     *
     */
    public function __construct(MaintenanceTypeRepository $maintenanceTypeRepository)
    {
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {


        foreach ($this->getMaintenanceType() as $type) {
            $t = new MaintenanceType(
                $type['id'],
                $type['name']
            );

            $this->maintenanceTypeRepository->save($t);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getMaintenanceType(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'Regular'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Not regular'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Hygiene'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Tires'
                ]
            ];
    }
}
