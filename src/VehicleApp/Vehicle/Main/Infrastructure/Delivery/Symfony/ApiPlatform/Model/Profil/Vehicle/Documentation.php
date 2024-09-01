<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Vehicle\UploadDocumentation;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    routePrefix: '/vehicles',
    normalizationContext: ['groups' => ['read'], 'skip_null_values' => false],
    collectionOperations: [
        'get',
        'post' => [
            'controller' => UploadDocumentation::class,
            'path' => '/vehicles/documentation',
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
class Documentation
{
    #[ApiProperty(identifier: true)]
    #[Assert\Uuid]
    public ?string $id = null;

    
    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Type(File::class, groups: ['create'])]
    #[Assert\File(
        maxSize :"1024k",
        mimeTypes:["application/pdf","application/x-pdf"],
        mimeTypesMessage:"Please upload a Valid PDF",
        groups: ['create']
    )]
    #[Groups(['create'])]
    public ?File $file = null;
    

    #[Assert\Type('string', groups: ['read', 'create_documentation'])]
    #[Groups(['read', 'create_documentation'])]
    public ?string $url = null;



    #[Assert\NotBlank(groups: ['create_documentation'])]
    #[Assert\Type('string', groups: ['read', 'create_documentation'])]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: 'Please enter at least {{ limit }} characters.',
        maxMessage: 'Cannot be longer than {{ limit }} characters.',
        groups: ['create', 'update']
    )]
    #[Groups(['read', 'create_documentation'])]
    public string $vehicle;

    /**
     * Image Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
