<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Identity;

use App\Common\Application\Query\QueryResult;
use App\Common\Application\Query\QueryHandler;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;

class UserCollectionQueryHandler implements QueryHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * UserCollectionQueryHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(UserRepository $userRepository, CollectionTransformer $collectionTransformer)
    {
        $this->userRepository = $userRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(UserCollectionQuery $query)
    {
        $repositoryQueryResult = $this->userRepository->query(
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
