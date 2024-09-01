<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\User;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter\Filter;
use App\Common\Infrastructure\Delivery\Symfony\Validator as CustomAssert;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Role\Role;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\User\AttachRole;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\User\DetachRole;

#[ApiResource(
    routePrefix: '/identity-access',
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
        'attach_role' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/users/{id}/roles/attach',
            'controller' => AttachRole::class,
            'validation_groups' => ['attach_role'],
            'denormalization_context' => ['groups' => 'attach_role'],
            'openapi_context' => [
                'summary' => 'Attach role to user',
                'description' => 'Attach role to user',
                'responses' => [
                    '204' => [
                        'description' => 'Role attached sucessfully',
                    ]
                ]
            ]
        ],
        'detach_role' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/users/{id}/roles/detach',
            'controller' => DetachRole::class,
            'validation_groups' => ['detach_role'],
            'denormalization_context' => ['groups' => 'detach_role'],
            'openapi_context' => [
                'summary' => 'Detach role from user',
                'description' => 'Detach role from user',
                'responses' => [
                    '204' => [
                        'description' => 'Role detached sucessfully',
                    ]
                ]
            ]
        ]
    ],
    subresourceOperations: [
        'roles_get_subresource' => [
            'method' => 'GET',
            'path' => '/identity-access/users/{id}/roles',
            'openapi_context' => [
                'summary' => 'Retreives user roles',
                'description' => 'Retreives user roles',
                'responses' => [
                    '200' => [
                        'description' => 'Role resource',
                        'content' => [
                            "application/ld+json" => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'hydra:member' => [
                                            'type' => 'array',
                                            'items' => [
                                                '$ref' => '#/components/schemas/Role.jsonld'
                                            ]
                                        ],
                                        'hydra:totalItems' => ['type' => 'integer', 'minimum' => 0],
                                    ],
                                    'required' => [
                                        'hydra:member'
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
)]
#[ApiFilter(Filter::class)]
class User
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
    public string $fullName;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 4,
        max: 100,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create', 'update'])]
    public string $username;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create', 'update'])]
    public string $email;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Type('string', groups: ['create'])]
    #[Assert\Length(
        min: 5,
        max: 35,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create']
    )]
    #[Groups(['create'])]
    public ?string $password = null;

    #[Assert\NotNull(groups: ['create', 'update'])]
    #[Assert\Type('bool', groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?bool $active = null;

    #[Assert\NotBlank(allowNull: true, groups: ['create', 'update'])]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Url(groups: ['create', 'update'])]
    #[CustomAssert\ImageRemoteUrl(groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?string $avatar = null;

    #[Assert\NotBlank(allowNull: false, groups: ['attach_role', 'detach_role'])]
    #[Assert\Type('string', groups: ['attach_role', 'detach_role'])]
    #[Assert\Uuid(groups: ['attach_role', 'detach_role'])]
    #[Groups(['attach_role', 'detach_role'])]
    public ?string $roleId = null;

    /**
     * @var Role[]
     */
    #[ApiSubresource(maxDepth: 0)]
    public ?array $roles = null;

    /**
     * User Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
