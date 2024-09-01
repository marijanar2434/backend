<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Access;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Query\QueryHandler;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;

class UserRolesCollectionQueryHandler implements QueryHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * UserRolesCollectionQueryHandler Constructor
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, CollectionTransformer $collectionTransformer)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(UserRolesCollectionQuery $query)
    {
        /**
         * @var User|null
         */
        $user = $this->userRepository->findById(new Id($query->getUserId()));

       
        if (empty($user)) {
            throw new UserNotFoundException();
        }
        

        $repositoryQueryResult = null;
        if ($query->getAttached()) {
            $repositoryQueryResult = $this->roleRepository->queryAttachedToUser(
                $user->getId(),
                new Criteria(
                    $query->getFilter(),
                    $query->getPage(),
                    $query->getLimit(),
                    $query->getOrder()
                )
            );
        } else {
            $repositoryQueryResult = $this->roleRepository->queryNotAttachedToUser(
                $user->getId(),
                new Criteria(
                    $query->getFilter(),
                    $query->getPage(),
                    $query->getLimit(),
                    $query->getOrder()
                )
            );
        }

        $this->collectionTransformer->write(
            $repositoryQueryResult->getResult()
        );

        return new QueryResult(
            $this->collectionTransformer->read(),
            $repositoryQueryResult->getTotal()
        );
    }
}
