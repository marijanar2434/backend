<?php

namespace App\Common\Infrastructure\Persistence\Doctrine\Query;

use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\Expression;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

abstract class DoctrineCriteriaBuilder implements CriteriaBuilder
{
    /**
     * @return array
     */
    protected function getSupportedOperators(): array
    {
        return [
            'in' => Comparison::IN,
            'nin' => Comparison::NIN,
            'ct' => Comparison::CONTAINS,
            'bw' => Comparison::STARTS_WITH,
            'ew' => Comparison::ENDS_WITH,
            'eq' => Comparison::EQ,
            'neq' => Comparison::NEQ,
            'gt' => Comparison::GT,
            'gte' => Comparison::GTE,
            'lt' => Comparison::LT,
            'lte' => Comparison::LTE
        ];
    }

    /**
     * @return array
     */
    protected abstract function getSupportedFields(): array;

    /**
     * @return array
     */
    protected function getSupportedFieldsMap(): array
    {
        return [];
    }

    /**
     * @param mixed $filters
     * @param string $operator
     * @param array $expressions
     * @param string $alias
     * 
     * @return array|Expression
     */
    private function arraysToExpressions($filters, $operator = 'and', $expressions = [], $alias = null): array|Expression
    {
        if (!is_array($filters)) {
            return $expressions;
        }

        $isAssocArray = fn (array $arr) => [] === $arr ? false : array_keys($arr) !== range(0, count($arr) - 1);
        $getKey = function (array $arr) {
            $keys = \array_keys($arr);
            return end($keys);
        };

        foreach ($filters as $filterKey => $filterValue) {

            if (\in_array($filterKey, ['or', 'and'], true) || is_int($filterKey)) {
                if (!\is_array($expressions)) {
                    $expressions = [$expressions];
                }
                $expressions[$filterKey] = $this->arraysToExpressions($filterValue, is_int($filterKey) ? $operator : $filterKey, [], $alias);
            }

            if (!in_array($filterKey, $this->getSupportedFields(), true)) {
                continue;
            }

            $criteria = DoctrineCriteria::create();
            $mappedFilterKey = $this->getSupportedFieldsMap()[$filterKey] ?? $filterKey;
            $mappedFilterKeyWithAlias = $alias === null ? $mappedFilterKey : sprintf('%s.%s', $alias, $mappedFilterKey);

            if (is_array($filterValue) && $isAssocArray($filterValue)) {
                foreach ($filterValue as $k => $v) {
                    if (is_string($v) && \strtolower($v) === 'null') {
                        \call_user_func_array([$criteria, empty($criteria->getWhereExpression()) ? 'where' : ($operator . 'Where')], [($this->getSupportedOperators()[$k] ?? '') === Comparison::NEQ ? DoctrineCriteria::expr()->neq($mappedFilterKeyWithAlias, null) : DoctrineCriteria::expr()->isNull($mappedFilterKeyWithAlias)]);
                    } else if (is_array($v) && $isAssocArray($v)) {
                        $_k = $getKey($v);
                        \call_user_func_array([$criteria, empty($criteria->getWhereExpression()) ? 'where' : ($operator . 'Where')], [new Comparison($mappedFilterKeyWithAlias, $this->getSupportedOperators()[$_k] ?? Comparison::EQ, $v[$_k])]);
                    } else {
                        \call_user_func_array([$criteria, empty($criteria->getWhereExpression()) ? 'where' : ($operator . 'Where')], [new Comparison($mappedFilterKeyWithAlias, $this->getSupportedOperators()[$k] ?? Comparison::EQ, $v)]);
                    }

                    break;
                }
            } else if (is_array($filterValue) && !$isAssocArray($filterValue)) {
                $comparisons = [];
                foreach ($filterValue as $k => $v) {
                    if (is_string($v) && \strtolower($v) === 'null') {
                        $comparisons[] = ($this->getSupportedOperators()[$k] ?? '') === Comparison::NEQ ? DoctrineCriteria::expr()->neq($mappedFilterKeyWithAlias, null) : DoctrineCriteria::expr()->isNull($mappedFilterKeyWithAlias);
                    } else {
                        $comparisons[] = new Comparison($mappedFilterKeyWithAlias, Comparison::EQ, $v);
                    }
                }

                $criteria->where(\call_user_func_array([DoctrineCriteria::expr(), $operator . 'X'], [...$comparisons]));
            } else {
                if (is_string($filterValue) && \strtolower($filterValue) === 'null') {
                    \call_user_func_array([$criteria, empty($criteria->getWhereExpression()) ? 'where' : ($operator . 'Where')], [DoctrineCriteria::expr()->isNull($mappedFilterKeyWithAlias)]);
                } else {
                    \call_user_func_array([$criteria, empty($criteria->getWhereExpression()) ? 'where' : ($operator . 'Where')], [new Comparison($mappedFilterKeyWithAlias, Comparison::EQ, $filterValue)]);
                }
            }

            $expressions = $criteria->getWhereExpression();
        }

        return $expressions;
    }

    /**
     * @param array $filters
     * @param string $operator
     * @param array $expressions
     * 
     * @return Expression|Expression[]
     */
    private function expressionsToCompositeExpression($filters, $operator = 'and', $expressions = []): Expression|array
    {
        foreach ($filters as $filterKey => $filterValue) {

            if (is_int($filterKey) && $filterValue instanceof Expression) {
                $expressions[] = $filterValue;
            }

            if (is_int($filterKey) && is_array($filterValue)) {
                $expressions[] = $this->expressionsToCompositeExpression($filterValue, $operator);
            }

            if (\in_array($filterKey, ['or', 'and'], true) && \is_array($filterValue)) {
                $expressions[] = $this->expressionsToCompositeExpression($filterValue, $filterKey);
            }
        }

        $expressions = array_filter($expressions, fn ($e) => !empty($e));

        if (empty($expressions)) {
            return $expressions;
        }

        if (\count($expressions) == 1) {
            return array_pop($expressions);
        }

        return \call_user_func_array([DoctrineCriteria::expr(), $operator . 'X'], [...$expressions]);
    }

    /**
     * @param array $filters
     * @param string $operator
     * @param array $expressions
     * 
     * @return array
     */
    private function transformFilters($filters, $operator = null, $expressions = []): array
    {
        foreach ($filters as $filterKey => $filterValue) {
            if (!is_int($filterKey) && !empty($operator)) {
                $expressions[] = [$filterKey => $filterValue];
            }

            if (!is_int($filterKey) && !\in_array($filterKey, ['or', 'and'], true) && empty($operator)) {
                $expressions['and'][] = [$filterKey => $filterValue];
            }

            if (\in_array($filterKey, ['or', 'and'], true) && \is_array($filterValue)) {
                $expressions[$filterKey] = $this->transformFilters($filterValue, $filterKey);
            }

            if (\is_int($filterKey) && !empty($operator)) {
                $expressions[$filterKey] = $filterValue;
            }
        }

        return $expressions;
    }

    /**
     * @param array $ordering
     * 
     * @return array
     */
    private function transformOrdering(array $ordering): array
    {
        $ordering = \array_intersect_key($ordering, array_flip($this->getSupportedFields()));
        $formattedOrdering = [];

        foreach ($ordering as $orderKey => $orderValue) {
            if (\in_array(\strtoupper($orderValue), ['ASC', 'DESC'], true)) {
                $formattedOrdering[$orderKey] = strtoupper($orderValue);
            }
        }

        return $formattedOrdering;
    }

    /**
     * @inheritDoc
     */
    public function build(Criteria $criteria, $alias = null): mixed
    {
        $page = abs($criteria->getPage());
        $limit = abs($criteria->getLimit());

        $doctrineCriteria = DoctrineCriteria::create();

        $transformedFilters = $this->transformFilters($criteria->getFilters());
        $expressions = $this->arraysToExpressions($transformedFilters, 'and', [], $alias);
        $compositeExpression = $this->expressionsToCompositeExpression($expressions);

        if (!empty($compositeExpression)) {
            $doctrineCriteria->where($compositeExpression);
        }

        if (!empty($criteria->getOrder())) {
            $doctrineCriteria->orderBy(
                $this->transformOrdering($criteria->getOrder())
            );
        }

        if (!empty($page)) {
            $doctrineCriteria->setFirstResult(abs(($page - 1)) * $limit);
        }

        if (!empty($limit)) {
            $doctrineCriteria->setMaxResults($limit);
        }

        return $doctrineCriteria;
    }
}
