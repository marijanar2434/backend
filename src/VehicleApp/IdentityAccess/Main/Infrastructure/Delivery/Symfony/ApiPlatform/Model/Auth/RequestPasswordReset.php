<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth\RequestPasswordReset as RequestPasswordResetAction;

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
        'request_password_reset' => [
            'status' => 204,
            'method' => 'POST',
            'path' => '/auth/request-password-reset',
            'controller' => RequestPasswordResetAction::class,
            'validation_groups' => ['request_password_reset'],
            'denormalization_context' => ['groups' => 'request_password_reset'],
            'openapi_context' => [
                'summary' => 'Request password reset',
                'description' => 'Request password reset',
                'requestBody' => [
                    'description' => 'Provide email where you want to get email with password reset instructions',
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RequestPasswordReset.jsonld'
                            ]
                        ],
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RequestPasswordReset'
                            ]
                        ],
                        'text/html' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RequestPasswordReset'
                            ]
                        ]
                    ],
                    'required' => true
                ],
                'responses' => [
                    '204' => [
                        'description' => 'Requested password reset sucessfully',
                    ]
                ]
            ]
        ]
    ]
)]
class RequestPasswordReset
{
    #[ApiProperty(identifier: true)]
    public ?string $id = null;

    #[Assert\NotBlank(groups: ['request_password_reset'])]
    #[Assert\Type('string', groups: ['request_password_reset'])]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
        groups: ['request_password_reset']
    )]
    #[Groups(['request_password_reset'])]
    public ?string $email = null;
}
