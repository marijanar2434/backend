<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Role;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter\Filter;

#[ApiResource(
    routePrefix: '/identity-access',
    normalizationContext: ['groups' => ['read'], 'skip_null_values' => false],
    attributes: [
        'validation_groups' => ['create']
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
            ]
        ],
        'patch' => [
            'method' => 'PATCH',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ]
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
class Role
{
    #[ApiProperty(identifier: true)]
    #[Assert\Type('string')]
    #[Assert\Uuid]
    #[Groups(['read', 'create'])]
    public ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
    )]
    #[Groups(['read', 'create'])]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex(
        pattern: '/^ROLE_(.)+/',
        message: 'Please start identifier with ROLE_ (ROLE_NAME).'
    )]
    #[Assert\Regex(
        pattern: '/^[A-Z\_\d]+$/',
        message: 'Please enter uppercase letters.'
    )]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
    )]
    #[Groups(['read', 'create'])]
    public string $identifier;

    #[Assert\NotNull]
    #[Assert\Type('bool')]
    #[Groups(['read', 'create'])]
    public ?bool $active = null;

    /**
     * Role Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
