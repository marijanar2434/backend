<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\Client;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;

class ClientCollectionQueryHandler  implements QueryHandler
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param ClientRepository $clientRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(ClientRepository $clientRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->clientRepository = $clientRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(ClientCollectionQuery $query)
    {
        $repositoryQueryResult = $this->clientRepository->query(
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
