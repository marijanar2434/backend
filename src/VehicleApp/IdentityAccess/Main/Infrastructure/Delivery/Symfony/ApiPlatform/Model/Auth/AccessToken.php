<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth\AccessToken as AccessTokenAction;

#[ApiResource(
    routePrefix: '/identity-access',
    normalizationContext: ['skip_null_values' => false],
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
        'access_token' => [
            'method' => 'POST',
            'path' => '/auth/access-token',
            'controller' => AccessTokenAction::class,
            'validation_groups' => ['access_token'],
            'denormalization_context' => ['groups' => 'access_token'],
            'normalization_context' => ['groups' => 'access_token_response'],
            'openapi_context' => [
                'summary' => 'Retrieves access token',
                'description' => 'Retrieves access token',
                'requestBody' => [
                    'description' => 'Provide username and password and retrieve access token',
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'required' => [
                                    'username',
                                    'password'
                                ],
                                'properties' => [
                                    'username' => [
                                        'minLength' => 4,
                                        'maxLength' => 300,
                                        'type' => 'string',
                                        'nullable' => true
                                    ],
                                    'password' => [
                                        'minLength' => 5,
                                        'maxLength' => 35,
                                        'type' => 'string',
                                        'nullable' => true
                                    ]
                                ]
                            ]
                        ],
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'required' => [
                                    'username',
                                    'password'
                                ],
                                'properties' => [
                                    'username' => [
                                        'minLength' => 4,
                                        'maxLength' => 300,
                                        'type' => 'string',
                                        'nullable' => true
                                    ],
                                    'password' => [
                                        'minLength' => 5,
                                        'maxLength' => 35,
                                        'type' => 'string',
                                        'nullable' => true
                                    ]
                                ]
                            ]
                        ],
                        'text/html' => [
                            'schema' => [
                                'type' => 'object',
                                'required' => [
                                    'username',
                                    'password'
                                ],
                                'properties' => [
                                    'username' => [
                                        'minLength' => 4,
                                        'maxLength' => 300,
                                        'type' => 'string',
                                        'nullable' => true
                                    ],
                                    'password' => [
                                        'minLength' => 5,
                                        'maxLength' => 35,
                                        'type' => 'string',
                                        'nullable' => true
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'required' => true
                ]
            ]
        ]
    ]
)]
class AccessToken
{
    #[ApiProperty(identifier: true)]
    public ?string $id = null;

    #[Assert\NotBlank(groups: ['access_token'])]
    #[Assert\Type('string', groups: ['access_token'])]
    #[Assert\Length(
        min: 4,
        max: 300,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['access_token']
    )]
    #[Groups(['access_token'])]
    public ?string $username = null;

    #[Assert\NotBlank(groups: ['access_token'])]
    #[Assert\Type('string', groups: ['access_token'])]
    #[Assert\Length(
        min: 5,
        max: 35,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['access_token']
    )]
    #[Groups(['access_token'])]
    public ?string $password = null;

    #[Groups(['access_token_response'])]
    public ?string $tokenType = null;

    #[Groups(['access_token_response'])]
    public ?string $expiresIn = null;

    #[Groups(['access_token_response'])]
    public ?string $accessToken = null;

    #[Groups(['access_token_response'])]
    public ?string $refreshToken = null;

    /**
     * AccessToken Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
