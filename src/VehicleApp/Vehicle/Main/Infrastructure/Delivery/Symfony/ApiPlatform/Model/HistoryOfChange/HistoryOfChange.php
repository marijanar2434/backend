<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\HistoryOfChange;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter\Filter;
use App\Common\Infrastructure\Delivery\Symfony\Validator as CustomAssert;
use DateTime;

#[ApiResource(
    routePrefix: '/vehicles',
    normalizationContext: ['groups' => ['read'], 'skip_null_values' => false],
    attributes: [
        'validation_groups' => ['create', 'update'],
    ],
    collectionOperations: [
        'get',
        'post' => [
            'validation_groups' => ['create']
        ]
    ],
    itemOperations: [
        'get' => [
            'method' => 'GET',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ]
        ],
        'put' => [
            'method' => 'PUT',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'validation_groups' => ['update'],
        ],
        'patch' => [
            'method' => 'PATCH',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'validation_groups' => ['update'],
        ],
        'delete' => [
            'method' => 'DELETE',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ]
        ]
    ]
)]
#[ApiFilter(Filter::class)]
class HistoryOfChange
{
    #[ApiProperty(identifier: true)]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Uuid(groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?string $id = null;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Groups(['read','create', 'update'])]
    public ?array $changes = null;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Uuid(groups: ['create', 'update'])]
    #[Groups(['create', 'update'])]
    public string $user;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
