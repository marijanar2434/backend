<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Brand\Fixtures;

use App\Common\Domain\ValueObject\Id;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;

class BrandFixtures extends Fixture
{
    /**
     * @var BrandRepository
     */
    private  $brandRepository;


    /**
     * UserFixtures Constructor
     *
     * @param BrandRepository $brandRepository
     *
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {


        foreach ($this->getBrands() as $brand) {
            $b = new Brand(
                $brand['id'],
                $brand['name']
            );

            $this->brandRepository->save($b);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getBrands(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'Audi'
                ],
                [
                    'id' => new Id(),
                    'name' => 'BMW'
                ],
                [
                    'id' => new Id(),
                    'name' => 'VW'
                ],
                [
                    'id' => new Id(),
                    'name' => 'VW Caddy'
                ],
            ];
    }
}
