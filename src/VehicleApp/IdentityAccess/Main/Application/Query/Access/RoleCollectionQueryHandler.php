<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Access;

use App\Common\Application\Query\QueryResult;
use App\Common\Application\Query\QueryHandler;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;

class RoleCollectionQueryHandler implements QueryHandler
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * RoleCollectionQueryHandler Constructor
     *
     * @param RoleRepository $roleRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(RoleRepository $roleRepository, CollectionTransformer $collectionTransformer)
    {
        $this->roleRepository = $roleRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(RoleCollectionQuery $query)
    {
        $repositoryQueryResult = $this->roleRepository->query(
            new Criteria(
                $query->getFilter(),
                $query->getPage(),
                $query->getLimit(),
                $query->getOrder()
            )
        );

        $this->collectionTransformer->write(
            $repositoryQueryResult->getResult()
        );

        return new QueryResult(
            $this->collectionTransformer->read(),
            $repositoryQueryResult->getTotal()
        );
    }
}
