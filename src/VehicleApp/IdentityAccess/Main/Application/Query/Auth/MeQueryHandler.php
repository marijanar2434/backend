<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Auth;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;

class MeQueryHandler implements QueryHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ItemTransformer
     */
    private $itemTransformer;

    /**
     * MeQueryHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param ItemTransformer $itemTransformer
     */
    public function __construct(UserRepository $userRepository, ItemTransformer $itemTransformer)
    {
        $this->userRepository = $userRepository;
        $this->itemTransformer = $itemTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(MeQuery $query)
    {
        $user = $this->userRepository->findById(new Id($query->getIdentifier()));

        $this->itemTransformer->write(
            $user
        );

        return new QueryResult(
            [$this->itemTransformer->read()],
            1
        );
    }
}
