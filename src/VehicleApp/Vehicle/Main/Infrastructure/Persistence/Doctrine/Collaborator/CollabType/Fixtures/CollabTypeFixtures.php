<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\CollabType\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CollabTypeFixtures extends Fixture
{
    /**
     * @var CollabTypeRepository
     */
    private $collabTypeRepository;


    /**
     * UserFixtures Constructor
     *
     * @param CollabTypeRepository $collabTypeRepository
     *
     */
    public function __construct(CollabTypeRepository $collabTypeRepository)
    {
        $this->collabTypeRepository = $collabTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getCollabTypes() as $ct) {
            $collabType = new CollabType(
                $ct['id'],
                $ct['name']
            );

            $this->collabTypeRepository->save($collabType);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getCollabTypes(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'Pump'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Car parts'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Mechanics'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Electricity'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Painting'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Car body'
                ]
            ];
    }
}
