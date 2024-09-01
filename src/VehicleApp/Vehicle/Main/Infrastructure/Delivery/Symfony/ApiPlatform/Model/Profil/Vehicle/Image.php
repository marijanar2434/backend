<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\CreateImage;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\UploadImage;

#[ApiResource(
    routePrefix: '/vehicles',
    normalizationContext: ['groups' => ['read'], 'skip_null_values' => false],
    collectionOperations: [
        'get',
        'post' => [
            'controller' => UploadImage::class,
            'path' => '/vehicles/image',
            'deserialize' => false,
            'validation_groups' => [],
            'openapi_context' => [
                'summary' => 'Upload vehicle image image to S3 bucket',
                'description' => 'Upload vehicle image image to S3 bucket',
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
class Image
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

    #[Assert\Type('string', groups: ['read', 'create_image'])]
    #[Groups(['read', 'create_image'])]
    public ?string $url = null;



    #[Assert\NotBlank(groups: ['create_image'])]
    #[Assert\Type('string', groups: ['read', 'create_image'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create_image'])]
    public string $vehicle;

    /**
     * Image Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
