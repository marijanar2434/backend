<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Registration;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;

class RegistrationCollectionQueryHandler implements QueryHandler
{
    /**
     * @var RegistrationRepository
     */
    private  $registrationRepository;

    /**
     * @var CollectionTransformer
     */
    private CollectionTransformer $collectionTransformer;

    /**
     * Constructor
     *
     * @param RegistrationRepository $registrationRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(RegistrationRepository $registrationRepository, CollectionTransformer $collectionTransformer)
    {
        $this->registrationRepository = $registrationRepository;
        $this->collectionTransformer = $collectionTransformer;
       
    }

    /**
     * @inheritDoc
     */
    public function __invoke(RegistrationCollectionQuery $query)
    {

        $repositoryQueryResult = $this->registrationRepository->query(
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