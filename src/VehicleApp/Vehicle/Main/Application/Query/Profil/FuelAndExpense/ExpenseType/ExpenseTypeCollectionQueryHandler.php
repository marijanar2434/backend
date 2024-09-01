<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;

class ExpenseTypeCollectionQueryHandler implements QueryHandler
{
    /**
     * @var ExpenseTypeRepository
     */
    private  $expenseTypeRepository;

    /**
     * @var CollectionTransformer
     */
    private  $collectionTransformer;

    /**
     *  Constructor
     *
     * @param ExpenseTypeRepository $expenseTypeRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(ExpenseTypeRepository $expenseTypeRepository, CollectionTransformer $collectionTransformer)
    {

        $this->expenseTypeRepository = $expenseTypeRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(ExpenseTypeCollectionQuery $query)
    {
        $repositoryQueryResult = $this->expenseTypeRepository->query(
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

