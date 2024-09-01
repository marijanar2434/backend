<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Type\Fixtures;


use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;
use App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Brand\Fixtures\BrandFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var TypeRepository
     */
    private  $typeRepository;

    /**
     * TypeFixtures Constructor
     *
     * @param TypeRepository $typeRepository
     * 
     */
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            BrandFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
    
        $brands = $manager->getRepository(Brand::class)->findAll();

        foreach ($this->getTypes() as $type) {

            foreach($brands as $b)
            {
                if($b->getName() == $type['brandName'])
                    $brand = $b;
            }

            $t = new Type(
                $type['id'],
                $type['name'],
                empty($brand) ? null : $brand
            );

            $this->typeRepository->save($t);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getTypes(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'A6',
                    'brandName' => 'Audi'
                ],
                [
                    'id' => new Id(),
                    'name' => 'A8',
                    'brandName' => 'Audi'
                ],
                [
                    'id' => new Id(),
                    'name' => 'A4',
                    'brandName' => 'Audi'
                ],
                [
                    'id' => new Id(),
                    'name' => 'X5',
                    'brandName' => 'BMW'
                ],
                [
                    'id' => new Id(),
                    'name' => 'M3',
                    'brandName' => 'BMW'
                ],
                [
                    'id' => new Id(),
                    'name' => '320D',
                    'brandName' => 'BMW'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Plavi novi',
                    'brandName' => 'VW Caddy'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Plavi stari',
                    'brandName' => 'VW Caddy'
                ],
            ];
    }
}
