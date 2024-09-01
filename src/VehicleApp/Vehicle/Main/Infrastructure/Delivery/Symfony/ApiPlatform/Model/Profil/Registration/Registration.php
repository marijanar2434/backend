<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Registration;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter\Filter;
use App\Common\Infrastructure\Delivery\Symfony\Validator as CustomAssert;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\Registration\CreateRegDocumentation;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\Registration\DeleteRegDocumentation;
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
        ],
        'create_reg_documentation' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/registrations/{id}/documentation/add',
            'controller' => CreateRegDocumentation::class,
            'validation_groups' => ['create_reg_documentation'],
            'denormalization_context' => ['groups' => 'create_reg_documentation'],
            'openapi_context' => [
                'summary' => 'Create documentation for registration',
                'description' => 'Create documentation for registration',
                'responses' => [
                    '204' => [
                        'description' => 'Documentation for registration created sucessfully',
                    ]
                ]
            ]
        ],
        'delete_reg_documentation' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/registrations/{id}/documentation/delete',
            'controller' => DeleteRegDocumentation::class,
            'validation_groups' => ['delete_reg_documentation'],
            'denormalization_context' => ['groups' => 'delete_reg_documentation'],
            'openapi_context' => [
                'summary' => 'Delete vehicle documentation',
                'description' => 'Delete vehicle documentation',
                'responses' => [
                    '204' => [
                        'description' => 'Documentation deleted sucessfully',
                    ]
                ]
            ]
        ],
    ]
)]
#[ApiFilter(Filter::class)]
class Registration
{
    #[ApiProperty(identifier: true)]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Uuid(groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?string $id = null;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create', 'update'])]
    public string $vehicle;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create'])]
    public string $user;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 10,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Assert\Regex(
        pattern: '/[A-Z]{2}-[0-9]{3,5}-[A-Z]{2}/',
        message: 'Please enter registration number in format LL-NNN(NN)-LL   (L - letter, N - number)',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create'])]
    public string $registrationNumber;


    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('\DateTimeInterface', groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public DateTimeImmutable $registrationStartDate;

    #[Assert\Type('\DateTimeInterface', groups: ['create', 'update'])]
    #[Groups(['read', 'create'])]
    public ?DateTimeImmutable $registrationExpire;


    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('integer', groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public int $registrationFee;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('integer', groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public int $timeOfUser;


    #[Assert\NotBlank(allowNull: true, groups: ['create_reg_documentation'])]
    #[Assert\Type('string', groups: ['create_reg_documentation'])]
    #[Assert\Url(groups: ['create_reg_documentation'])]
    #[Groups(['create_reg_documentation'])]
    public ?string $url = null;

    #[Assert\Type('string', groups: ['delete_reg_documentation'])]
    #[Groups(['delete_reg_documentation'])]
    public ?string $docId = null;

    #[Groups(['read', 'create', 'update'])]
    public ?array $documentations = null;


    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
