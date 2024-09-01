<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Repository;

use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Service\Hasher\Hasher;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\Client;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\ClientRepository as AppClientRepository;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2\Entity\ClientEntity;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @var AppClientRepository
     */
    private $appClientRepository;

    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * ClientRepository Constructor
     *
     * @param AppClientRepository $appClientRepository
     * @param Hasher $hasher
     */
    public function __construct(AppClientRepository $appClientRepository, Hasher $hasher)
    {
        $this->appClientRepository = $appClientRepository;
        $this->hasher = $hasher;
    }

    /**
     * @inheritDoc
     */
    public function getClientEntity($clientIdentifier): ?ClientEntityInterface
    {
        /**
         * @var Client|null
         */
        $appClient = $this->appClientRepository->findById(new Id($clientIdentifier));

        $client = new ClientEntity();
        $client->setIdentifier($appClient->getId());
        $client->setName($appClient->getName());
        $client->setRedirectUri($appClient->getRedirectUri());

        if ($appClient->getConfidential()) {
            $client->setConfidential();
        }

        return $client;
    }

    /**
     * @inheritDoc
     */
    public function validateClient($clientIdentifier, $clientSecret, $grantType): bool
    {
        /**
         * @var Client|null
         */
        $appClient = $this->appClientRepository->findById(new Id($clientIdentifier));

        if (empty($appClient)) {
            return false;
        }

        if ($appClient->getConfidential() === true && $this->hasher->verify($clientSecret, $appClient->getSecret()) === false) {
            return false;
        }

        return true;
    }
}
