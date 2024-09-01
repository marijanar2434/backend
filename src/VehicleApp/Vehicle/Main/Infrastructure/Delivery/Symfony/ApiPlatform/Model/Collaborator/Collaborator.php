<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Collaborator;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter\Filter;
use App\Common\Infrastructure\Delivery\Symfony\Validator as CustomAssert;
use DateTimeImmutable;

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
class Collaborator
{
    #[ApiProperty(identifier: true)]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Uuid(groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?string $id = null;

    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read'])]
    public string $fullname;


    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 100,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create']
    )]
    #[Groups(['read'])]
    public string $address;

    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 14,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read'])]
    public string $phoneNumber;


    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read'])]
    public string $website;


    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 250,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read'])]
    public string $email;

   
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 250,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read'])]
    public string $companyCode;

    
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 250,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read'])]
    public string $companyName;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Groups(['read','create', 'update'])]
    public ?array $types = null;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['create', 'update'])]
    public string $client;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['create', 'update'])]
    public string $company;


    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
