<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Color\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture 
{
    /**
     * @var ColorRepository
     */
    private  $colorRepository;


    /**
     * ColorFixtures Constructor
     *
     * @param ColorRepository $colorRepository
     * 
     */
    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
    
       

        foreach ($this->getColors() as $color) {
            $c = new Color(
                $color['id'],
                $color['name']
            );

            $this->colorRepository->save($c);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getColors(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'GREEN'
                ],
                [
                    'id' => new Id(),
                    'name' => 'BLUE'
                ],
                [
                    'id' => new Id(),
                    'name' => 'GRAY'
                ],
                [
                    'id' => new Id(),
                    'name' => 'BLACK'
                ],
                [
                    'id' => new Id(),
                    'name' => 'CYAN'
                ]
            ];
    }
}
