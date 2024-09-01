<?php

namespace App\Common\Domain;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Infrastructure\Persistence\Query\Criteria;

interface Repository
{
    /**
     * @param Id $id
     *
     * @return Entity|null
     */
    public function findById(Id $id): ?Entity;

    /**
     * @param Entity $entity
     * 
     * @return void
     */
    public function save(Entity $entity): void;

    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @return void
     */
    public function clear(): void;

    /**
     * @param Entity $entity
     * 
     * @return void
     */
    public function remove(Entity $entity): void;

    /**
     * @return void
     */
    public function removeAll(): void;

    /**
     * @return Id
     */
    public function nextIdentity(): Id;

    /**
     * @param Criteria $criteria
     * 
     * @return RepositoryQueryResult
     */
    public function query(Criteria $criteria): RepositoryQueryResult;

    /**
     * @param Criteria|null $criteria
     * @param callable $callback
     * 
     * @return void
     */
    public function forEach(callable $callback, ?Criteria $criteria = null): void;

    /**
     * @param Criteria|null $criteria
     * 
     * @return iterable
     */
    public function toIterable(?Criteria $criteria = null): iterable;
}
