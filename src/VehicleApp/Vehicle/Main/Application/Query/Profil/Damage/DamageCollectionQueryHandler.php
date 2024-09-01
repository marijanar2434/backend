<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Damage;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;

class DamageCollectionQueryHandler implements QueryHandler
{
    /**
     * @var DamageRepository
     */
    private $damageRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param DamageRepository $damageRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(DamageRepository $damageRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->damageRepository = $damageRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DamageCollectionQuery $query)
    {
        $repositoryQueryResult = $this->damageRepository->query(
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

