<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth\Fixtures;

use App\Common\Domain\ValueObject\Id;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Common\Infrastructure\Service\Hasher\Hasher;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\Client;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\ClientRepository;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;

class ClientFixtures extends Fixture
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * ClientFixtures Constructor
     *
     * @param ClientRepository $clientRepository
     * @param Hasher $hasher
     * @param ServerConfiguration $serverConfiguration
     */
    public function __construct(ClientRepository $clientRepository, Hasher $hasher, ServerConfiguration $serverConfiguration)
    {
        $this->clientRepository = $clientRepository;
        $this->hasher = $hasher;
        $this->serverConfiguration = $serverConfiguration;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->clientRepository->save(
            new Client(
                new Id(),
                'Resource owner password credentials grant',
                $this->hasher->hash($this->serverConfiguration->getAppSecret()),
                '',
                true,
                true,
                true
            )
        );

        $manager->flush();
    }
}
