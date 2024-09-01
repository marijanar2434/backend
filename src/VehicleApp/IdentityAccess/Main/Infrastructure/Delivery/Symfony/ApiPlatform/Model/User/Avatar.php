<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\User;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\User\UploadAvatar;

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
        'post' => [
            'controller' => UploadAvatar::class,
            'path' => '/users/avatar',
            'deserialize' => false,
            'validation_groups' => [],
            'openapi_context' => [
                'summary' => 'Upload user avatar image to S3 bucket',
                'description' => 'Upload user avatar image to S3 bucket',
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]
    ]
)]
class Avatar
{
    #[ApiProperty(identifier: true)]
    #[Assert\Uuid]
    public ?string $id = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Type(File::class, groups: ['create'])]
    #[Assert\File(maxSize: '2M', groups: ['create'])]
    #[Assert\Image(
        detectCorrupted: true,
        groups: ['create']
    )]
    #[Groups(['create'])]
    public ?File $file = null;

    #[Groups(['read'])]
    public ?string $url = null;

    /**
     * Avatar Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
