<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth\PasswordReset as PasswordResetAction;

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
        'password_reset' => [
            'status' => 204,
            'method' => 'POST',
            'path' => '/auth/password-reset',
            'controller' => PasswordResetAction::class,
            'validation_groups' => ['password_reset'],
            'denormalization_context' => ['groups' => 'password_reset'],
            'openapi_context' => [
                'summary' => 'Password reset',
                'description' => 'Password reset',
                'requestBody' => [
                    'description' => 'Provide password, password confirmation and other data received on request password reset',
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/PasswordReset.jsonld'
                            ]
                        ],
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/PasswordReset'
                            ]
                        ],
                        'text/html' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/PasswordReset'
                            ]
                        ]
                    ],
                    'required' => true
                ],
                'responses' => [
                    '204' => [
                        'description' => 'Password reseted sucessfully',
                    ]
                ]
            ]
        ]
    ]
)]
class PasswordReset
{
    #[ApiProperty(identifier: true)]
    public ?string $id = null;

    #[Assert\NotBlank(groups: ['password_reset'])]
    #[Assert\Type('string', groups: ['password_reset'])]
    #[Assert\Length(
        min: 5,
        max: 35,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['password_reset']
    )]
    #[Groups(['password_reset'])]
    public ?string $password = null;

    #[Assert\NotBlank(groups: ['password_reset'])]
    #[Assert\Type('string', groups: ['password_reset'])]
    #[Assert\Length(
        min: 5,
        max: 35,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['password_reset']
    )]
    #[Groups(['password_reset'])]
    public ?string $passwordConfirmation = null;

    #[Assert\NotBlank(groups: ['password_reset'])]
    #[Assert\Type('string', groups: ['password_reset'])]
    #[Assert\Uuid(groups: ['password_reset'])]
    #[Groups(['password_reset'])]
    public ?string $passwordRequestId = null;

    #[Assert\NotBlank(groups: ['password_reset'])]
    #[Assert\Type('string', groups: ['password_reset'])]
    #[Assert\Uuid(groups: ['password_reset'])]
    #[Groups(['password_reset'])]
    public ?string $userId = null;
}
