<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;

class CollaboratorCollectionQueryHandler implements QueryHandler
{
    /**
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param CollaboratorRepository $collaboratorRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(CollaboratorRepository $collaboratorRepository, CollectionTransformer $collectionTransformer)
    {

        $this->collaboratorRepository = $collaboratorRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CollaboratorCollectionQuery $query)
    {
        $repositoryQueryResult = $this->collaboratorRepository->query(
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




