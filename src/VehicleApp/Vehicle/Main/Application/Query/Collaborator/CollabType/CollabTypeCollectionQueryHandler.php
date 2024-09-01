<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\CollabType;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;

class CollabTypeCollectionQueryHandler implements QueryHandler
{
    /**
     * @var CollabTypeRepository
     */
    private $collabTypeRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param CollabTypeRepository $collabTypeRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(CollabTypeRepository $collabTypeRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->collabTypeRepository = $collabTypeRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CollabTypeCollectionQuery $query)
    {
        $repositoryQueryResult = $this->collabTypeRepository->query(
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
