<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\FuelAndExpense\ExpenseType\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpenseTypeFixtures extends Fixture
{
    /**
     * @var ExpenseTypeRepository
     */
    private   $expenseTypeRepository;


    /**
     * UserFixtures Constructor
     *
     * @param ExpenseTypeRepository $expenseTypeRepository
     *
     */
    public function __construct(ExpenseTypeRepository $expenseTypeRepository)
    {
        $this->expenseTypeRepository = $expenseTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {


        foreach ($this->getExpenseType() as $type) {
            $t = new ExpenseType(
                $type['id'],
                $type['name']
            );

            $this->expenseTypeRepository->save($t);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getExpenseType(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'Fuel'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Tag'
                ],
                [
                    'id' => new Id(),
                    'name' => 'Wash'
                ]
            ];
    }
}

