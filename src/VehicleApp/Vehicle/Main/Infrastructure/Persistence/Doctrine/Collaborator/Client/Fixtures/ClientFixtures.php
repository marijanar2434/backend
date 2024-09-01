<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\Client\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;


    /**
     * UserFixtures Constructor
     *
     * @param ClientRepository $clientRepository
     *
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getClients() as $client) {
            $client = new Client(
                $client['id'],
                $client['fullname'],
                $client['address'],
                $client['phoneNumber'],
                $client['email'],
                $client['website']
            );

            $this->clientRepository->save($client);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getClients(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'fullname' => 'Pera Peric',
                    'address' => 'Omladinskih brigada 90A, Novi Beograd',
                    'phoneNumber' => '011 2071500',
                    'email' => 'info.serbia@omv.com',
                    'website' => 'www.omv.co.rs'
                ],
                [
                    'id' => new Id(),
                    'fullname' => 'Jovan Jovanović',
                    'address' => 'Tošin bunar 179, Novi Beograd',
                    'phoneNumber' => '011 713 88 48	',
                    'email' => 'thule@lavauto.',
                    'website' => 'lavauto.rs'
                ],
                [
                    'id' => new Id(),
                    'fullname' => 'Mira Mirić',
                    'address' => 'Cara Dusana 209, Zemun',
                    'phoneNumber' => '060 70 10 396',
                    'email' => 'servis@akkole.',
                    'website' => 'www.akkole.rs'
                ],
                [
                    'id' => new Id(),
                    'fullname' => 'Bojan Mirković',
                    'address' => 'Abebe Bikile 4b',
                    'phoneNumber' => '065 2 51 51 60',
                    'email' => 'info@autolimar.rs',
                    'website' => 'www.autolimar.rs'
                ]
                
            ];
    }
}
