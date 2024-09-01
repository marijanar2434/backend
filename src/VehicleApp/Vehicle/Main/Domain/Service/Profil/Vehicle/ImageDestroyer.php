<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Vehicle;

use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\Image;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\ImageRepository;

class ImageDestroyer
{
    /**
     * @var ImageRepository
     */
    private   $imageRepository;

    /**
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * 
     *
     * @param Image $image
     * @return void
     */
    public function destroy(Image $image): void
    {
        $this->imageRepository->remove($image);
    }
}
