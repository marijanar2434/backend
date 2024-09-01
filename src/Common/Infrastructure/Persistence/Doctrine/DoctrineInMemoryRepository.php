<?php

namespace App\Common\Infrastructure\Persistence\Doctrine;

use App\Common\Domain\Entity;
use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\ValueObject;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyAccess\PropertyAccess;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineInMemoryRepository implements Repository
{
    /**
     * @var DoctrineRepository
     */
    protected $repository;

    /**
     * @var ArrayCollection
     */
    protected $memory;

    /**
     * DoctrineInMemoryRepository Constructor
     *
     * @param DoctrineRepository $repository
     */
    public function __construct(DoctrineRepository $repository)
    {
        $this->repository = $repository;
        $this->memory = new ArrayCollection();
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * 
     * @return Entity|null
     */
    protected function _findOneBy($attribute, $value): ?Entity
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $result = $this->memory
            ->filter(fn ($element) => $value instanceof ValueObject ?
                $value->equals($propertyAccessor->getValue($element, $attribute)) : $propertyAccessor->getValue($element, $attribute) === $value)
            ->first();

        if (empty($result)) {
            return null;
        }

        return $result;
    }

    /**
     * @param Entity $entity
     * 
     * @return void
     */
    protected function _save(Entity $entity): void
    {
        if (!empty($this->_findOneBy('id', $entity->getId()))) {
            return;
        }

        $this->memory->add($entity);
    }

    /**
     * @param Entity $entity
     * 
     * @return void
     */
    protected function _remove($entity): void
    {
        $this->memory = $this->memory->filter(fn ($element) => $element->equals($entity->getId()));
    }

    /**
     * @inheritDoc
     */
    public function findById(Id $id): ?Entity
    {
        $entity = $this->_findOneBy('id', $id);

        if (!empty($entity)) {
            return $entity;
        }

        $entity = $this->repository->findById($id);

        if (!empty($entity)) {
            $this->_save($entity);
        }

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function save(Entity $entity): void
    {
        $this->repository->save($entity);

        $this->_save($entity);
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        $this->repository->flush();
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        // @phpstan-ignore-next-line
        $this->repository->clear();
    }

    /**
     * @inheritDoc
     */
    public function remove(Entity $entity): void
    {
        $this->repository->remove($entity);

        $this->_remove($entity);
    }

    /**
     * @inheritDoc
     */
    public function removeAll(): void
    {
        $this->repository->removeAll();
        $this->memory->clear();
    }

    /**
     * @inheritDoc
     */
    public function nextIdentity(): Id
    {
        return $this->repository->nextIdentity();
    }

    /**
     * @inheritDoc
     */
    public function query(Criteria $criteria): RepositoryQueryResult
    {
        return $this->repository->query($criteria);
    }

    /**
     * @inheritDoc
     */
    public function forEach(callable $callback, ?Criteria $criteria = null): void
    {
        $this->repository->forEach($callback, $criteria);
    }

    /**
     * @inheritDoc
     */
    public function toIterable(?Criteria $criteria = null): iterable
    {
        return $this->repository->toIterable($criteria);
    }
}
