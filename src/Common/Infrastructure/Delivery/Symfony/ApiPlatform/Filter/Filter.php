<?php

namespace App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter;

use ReflectionClass;
use ReflectionProperty;
use ReflectionNamedType;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\Serializer\Filter\FilterInterface;

class Filter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        $extract = ['page', 'filter', 'sort'];

        $data = [];
        foreach ($extract as $param) {
            try {
                $data[$param] = $request->query->all($param);
            } catch (\Exception $e) {
                $data[$param] = $request->query->get($param);
            }
        }

        $context['_filters'] = $data;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(string $resourceClass): array
    {
        $description = [];

        $properties = (new ReflectionClass($resourceClass))->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $description[sprintf('filter[%s]', $property->getName())] = [
                'property' => $property->getName(),
                'type' => $property->getType() instanceof ReflectionNamedType ? $property->getType()->getName() : null,
                'required' => false
            ];
        }

        return $description;
    }
}
