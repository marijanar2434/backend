<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth\Fixtures\ClientFixtures;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\CollabType\Fixtures\CollabTypeFixtures;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\Company\Fixtures\CompanyFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CollaboratorFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;



    /**
     * TypeFixtures Constructor
     *
     * @param CollaboratorRepository $collaboratorRepository
     * 
     */
    public function __construct(CollaboratorRepository $collaboratorRepository)
    {
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            CollabTypeFixtures::class,
            ClientFixtures::class,
            CompanyFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $companies = $manager->getRepository(Company::class)->findAll();
        $types = $manager->getRepository(CollabType::class)->findAll();
        $clients = $manager->getRepository(Client::class)->findAll();


        foreach ($this->getCollaborators() as $collaborator) {


            $typesArray = [];

            foreach ($types as $type) {
                if ( in_array($type->getName(),$collaborator['types'],true)) {
                    $typesArray[] = $type;
                }
            }

          

            $mn =  new Collaborator(
                $collaborator['id'],
                $clients[$collaborator['client']],
                $companies[$collaborator['company']],
                $typesArray
            );


            $this->collaboratorRepository->save($mn);
        }


        $manager->flush();
    }

    /**
     * @return array
     */
    private function getCollaborators(): array
    {

        return
            [
                [
                    'id' => new Id(),
                    "company" => 0,
                    "client" => 0,
                    "types" => ["Pump"]
                ],
                [
                    'id' => new Id(),
                    "company" => 1,
                    "client" => 1,
                    "types" => ["Electricity"]
                ],
                [
                    'id' => new Id(),
                    "company" => 2,
                    "client" => 2,
                    "types" => ["Painting"]
                ],
                [
                    'id' => new Id(),
                    "company" => 3,
                    "client" => 3,
                    "types" => ["Car body", "Car parts"]
                ]
            ];
    }
}
