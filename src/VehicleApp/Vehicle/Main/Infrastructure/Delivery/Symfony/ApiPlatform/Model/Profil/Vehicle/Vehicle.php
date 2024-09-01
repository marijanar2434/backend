<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Filter\Filter;
use App\Common\Infrastructure\Delivery\Symfony\Validator as CustomAssert;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\AttachUser;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\CreateDocumentation;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\CreateImage;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\CreateVehicleDocumentation;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\DeleteDocumentation;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\DeleteImage;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\DetachUser;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\UserVehicle\UserVehicle;
use DateTimeImmutable;

#[ApiResource(
    routePrefix: '/vehicles',
    normalizationContext: ['groups' => ['read'], 'skip_null_values' => false],
    attributes: [
        'validation_groups' => ['create', 'update', 'create_image', 'delete_image', 'create_documentation'],
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
        'attach_user' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/vehicles/{id}/users/attach',
            'controller' => AttachUser::class,
            'validation_groups' => ['attach_user'],
            'denormalization_context' => ['groups' => 'attach_user'],
            'openapi_context' => [
                'summary' => 'Attach user to vehicle',
                'description' => 'Attach user to vehicle',
                'responses' => [
                    '204' => [
                        'description' => 'User attached sucessfully',
                    ]
                ]
            ]
        ],
        'detach_user' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/vehicles/{id}/users/detach',
            'controller' => DetachUser::class,
            'validation_groups' => ['detach_user'],
            'denormalization_context' => ['groups' => 'detach_user'],
            'openapi_context' => [
                'summary' => 'Detach user from vehicle',
                'description' => 'Detach user from vehicle',
                'responses' => [
                    '204' => [
                        'description' => 'User detached sucessfully',
                    ]
                ]
            ]
        ],
        'create_image' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/vehicles/{id}/image/add',
            'controller' => CreateImage::class,
            'validation_groups' => ['create_image'],
            'denormalization_context' => ['groups' => 'create_image'],
            'openapi_context' => [
                'summary' => 'Create image for vehicle',
                'description' => 'Create image from vehicle',
                'responses' => [
                    '204' => [
                        'description' => 'Image created sucessfully',
                    ]
                ]
            ]
        ],
        'delete_image' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/vehicles/{id}/image/delete',
            'controller' => DeleteImage::class,
            'validation_groups' => ['delete_image'],
            'denormalization_context' => ['groups' => 'delete_image'],
            'openapi_context' => [
                'summary' => 'Delete vehicle image',
                'description' => 'Delete vehicle image',
                'responses' => [
                    '204' => [
                        'description' => 'Image deleted sucessfully',
                    ]
                ]
            ]
        ],
        'create_documentation' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/vehicles/{id}/documentation/add',
            'controller' => CreateVehicleDocumentation::class,
            'validation_groups' => ['create_documentation'],
            'denormalization_context' => ['groups' => 'create_documentation'],
            'openapi_context' => [
                'summary' => 'Create documentation for vehicle',
                'description' => 'Create documentation from vehicle',
                'responses' => [
                    '204' => [
                        'description' => 'Documentation created sucessfully',
                    ]
                ]
            ]
        ],
        'delete_documentation' => [
            'status' => 204,
            'method' => 'POST',
            'requirements' => [
                'id' => '%app.uuid.regex%'
            ],
            'path' => '/vehicles/{id}/documentation/delete',
            'controller' => DeleteDocumentation::class,
            'validation_groups' => ['delete_documentation'],
            'denormalization_context' => ['groups' => 'delete_documentation'],
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
    ],
    subresourceOperations: [
        'registrations_get_subresource' => [
            'method' => 'GET',
            'path' => '/vehicles/vehicles/{id}/registrations',
            'openapi_context' => [
                'summary' => 'Retreives vehicle registrations',
                'description' => 'Retreives vehicle registrations',
                'responses' => [
                    '200' => [
                        'description' => 'Vehicle resource',
                        'content' => [
                            "application/ld+json" => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'hydra:member' => [
                                            'type' => 'array',
                                            'items' => [
                                                '$ref' => '#/components/schemas/Vehicle.jsonld'
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
        ],
        'fuelandexpenses_get_subresource' => [
            'method' => 'GET',
            'path' => '/vehicles/vehicles/{id}/fuel-and-expenses',
            'openapi_context' => [
                'summary' => 'Retreives vehicle fuel and expeses',
                'description' => 'Retreives vehicle fuel and expeses',
                'responses' => [
                    '200' => [
                        'description' => 'Vehicle resource',
                        'content' => [
                            "application/ld+json" => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'hydra:member' => [
                                            'type' => 'array',
                                            'items' => [
                                                '$ref' => '#/components/schemas/Vehicle.jsonld'
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
        ],
        'maintenance_get_subresource' => [
            'method' => 'GET',
            'path' => '/vehicles/vehicles/{id}/maintenances',
            'openapi_context' => [
                'summary' => 'Retreives vehicle maintenances',
                'description' => 'Retreives vehicle maintenances',
                'responses' => [
                    '200' => [
                        'description' => 'Vehicle resource',
                        'content' => [
                            "application/ld+json" => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'hydra:member' => [
                                            'type' => 'array',
                                            'items' => [
                                                '$ref' => '#/components/schemas/Vehicle.jsonld'
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
        ],
        'damages_get_subresource' => [
            'method' => 'GET',
            'path' => '/vehicles/vehicles/{id}/damages',
            'openapi_context' => [
                'summary' => 'Retreives vehicle damages',
                'description' => 'Retreives vehicle damages',
                'responses' => [
                    '200' => [
                        'description' => 'Vehicle resource',
                        'content' => [
                            "application/ld+json" => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'hydra:member' => [
                                            'type' => 'array',
                                            'items' => [
                                                '$ref' => '#/components/schemas/Vehicle.jsonld'
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
class Vehicle
{
    #[ApiProperty(identifier: true)]
    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Uuid(groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?string $id = null;

    #[Assert\Type('string', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create', 'update'])]
    public string $brand;

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
    public string $type;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('integer', groups: ['create', 'update'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create', 'update'])]
    public int $price;

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
    public string $color;

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
    public string $engineNumber;

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
    public string $chassisNumber;

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
    public string $yearOfProduction;

    #[Assert\NotBlank(groups: ['create', 'update'])]
    #[Assert\Type('\DateTimeInterface', groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public DateTimeImmutable $vehicleActiveFrom;

    #[Assert\Type('\DateTimeInterface', groups: ['create', 'update'])]
    #[Groups(['read', 'create', 'update'])]
    public ?DateTimeImmutable $vehicleActiveTo;


    #[Assert\Type('string', groups: ['attach_user', 'detach_user'])]
    #[Assert\Uuid(groups: ['attach_user', 'detach_user'])]
    #[Groups(['attach_user', 'detach_user'])]
    public ?string $userId = null;


    #[Groups(['read', 'create', 'update'])]
    public ?array $users = null;

    #[Groups(['read', 'create', 'update'])]
    public ?array $images = null;

    #[Groups(['read', 'create', 'update'])]
    public ?array $documentations = null;

    #[Assert\Type('string', groups: ['create'])]
    #[Groups(['read'])]
    public string $typeOfUser;


    #[Assert\NotBlank(allowNull: true, groups: ['create_image'])]
    #[Assert\Type('string', groups: ['create_image'])]
    #[Assert\Url(groups: ['create_image'])]
    #[CustomAssert\ImageRemoteUrl(groups: ['create_image'])]
    #[Groups(['create_image'])]
    public ?string $url = null;


    #[Assert\Type('string', groups: ['delete_image'])]
    #[Groups(['delete_image'])]
    public ?string $imageId = null;


    #[Assert\Type('string', groups: ['delete_documentation'])]
    #[Groups(['delete_documentation'])]
    public ?string $docId = null;


    #[Assert\NotBlank(allowNull: true, groups: ['create_documentation'])]
    #[Assert\Type('string', groups: ['create_documentation'])]
    #[Assert\Url(groups: ['create_documentation'])]
    #[Groups(['create_documentation'])]
    public ?string $urlDoc = null;


    /**
     * @var Registration[]
     */
    #[ApiSubresource(maxDepth: 0)]
    public ?array $registrations = null;


    /**
     * @var FuelAndExpense[]
     */
    #[ApiSubresource(maxDepth: 0)]
    public ?array $fuelAndExpenses = null;


    /**
     * @var Maintenance[]
     */
    #[ApiSubresource(maxDepth: 0)]
    public ?array $maintenances = null;

    /**
     * @var Damage[]
     */

    #[ApiSubresource(maxDepth: 0)]
    public ?array $damages = null;

    public function __construct()
    {

        $this->id = Uuid::uuid4()->toString();
    }
}
