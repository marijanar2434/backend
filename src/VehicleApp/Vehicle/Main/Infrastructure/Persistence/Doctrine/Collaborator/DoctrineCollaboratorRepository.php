<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator;

use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;

class DoctrineCollaboratorRepository  extends DoctrineRepository implements CollaboratorRepository
{

    public function findByName(string $name): ?Collaborator
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function FindByClientAndCompany(Client $client, Company $company): ?Collaborator
    {

        return $this->findOneBy([
            'client' => $client,
            'company' => $company
        ]);
    }

    public function countByClientId(Id $clientId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator u JOIN u.client c WHERE c.id = :clientId')
            ->setParameter('clientId', $clientId)
            ->getSingleScalarResult();
    }

    public function countByCollabTypetId(Id $collabTypeId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator u JOIN u.types c WHERE c.id = :collabTypeId')
            ->setParameter('collabTypeId', $collabTypeId)
            ->getSingleScalarResult();
    }

    public function countByCompanytId(Id $companyId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator u JOIN u.company c WHERE c.id = :companyId')
            ->setParameter('companyId', $companyId)
            ->getSingleScalarResult();
    }
}
