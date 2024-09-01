<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth\Me as MeAction;

#[ApiResource(
    routePrefix: '/identity-access',
    normalizationContext: ['groups' => ['read'], 'skip_null_values' => false],
    itemOperations: [
        'get' => [
            'controller' => NotFoundAction::class,
            'read' => false,
            'output' => false,
            'openapi_context' => [
                'summary' => 'Ignore this route. This route does nothing. It is showing here due to Api platform limitations',
                'description' => 'Ignore this route. This route does nothing. It is showing here due to Api platform limitations'
            ]
        ],
    ],
    collectionOperations: [
        'me' => [
            'method' => 'GET',
            'path' => '/auth/me.{_format}',
            'controller' => MeAction::class,
            'denormalization_context' => ['groups' => 'read'],
            'openapi_context' => [
                'summary' => 'Retreive user resource by access token in header',
                'description' => 'Retreive user resource by access token in header',
                'responses' => [
                    '200' => [
                        'description' => 'User resource',
                        'content' => [
                            'application/ld+json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User.jsonld'
                                ]
                            ],
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User'
                                ]
                            ],
                            'text/html' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
)]
class Me
{
    #[ApiProperty(identifier: true)]
    #[Groups(['read'])]
    public ?string $id = null;

    #[Groups(['read'])]
    public string $fullName;

    #[Groups(['read'])]
    public string $username;

    #[Groups(['read'])]
    public string $email;

    #[Groups(['read'])]
    public ?string $password = null;

    #[Groups(['read'])]
    public ?bool $active = null;

    #[Groups(['read'])]
    public ?string $avatar = null;

    /**
     * Me Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
