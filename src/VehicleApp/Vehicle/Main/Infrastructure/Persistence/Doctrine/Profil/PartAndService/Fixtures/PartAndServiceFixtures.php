<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\PartAndService\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PartAndServiceFixtures extends Fixture
{
    /**
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;


    /**
     * UserFixtures Constructor
     *
     * @param PartAndServiceRepository $partAndServiceRepository
     *
     */
    public function __construct(PartAndServiceRepository $partAndServiceRepository)
    {
        $this->partAndServiceRepository = $partAndServiceRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getPartAndServices() as $part) {
            $p = new PartAndService(
                $part['id'],
                $part['name']
            );

            $this->partAndServiceRepository->save($p);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getPartAndServices(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'Car oil'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Filters'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Tiles'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Accumulator'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Replacement of the air conditioner'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Replacing winter tires with summer tires'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Parts replacement'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Painting'
                ]

            ];
    }
}
