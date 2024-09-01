<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\Company\Fixtures;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;


    /**
     * ColorFixtures Constructor
     *
     * @param CompanyRepository $companyRepository
     * 
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {



        foreach ($this->getCompanies() as $company) {
            $c = new Company(
                $company['id'],
                $company['name'],
                $company['companyCode']
            );

            $this->companyRepository->save($c);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getCompanies(): array
    {
        return
            [
                [
                    'id' => new Id(),
                    'name' => 'OMV SRBIJA DOO',
                    'companyCode' => 'CLIDOM2016101471156'
                ],
                [
                    'id' => new Id(),
                    'name' => 'LAV AUTO DOO BEOGRAD',
                    'companyCode' => 'CLIDOM2020021888378'
                ],
                [
                    'id' => new Id(),
                    'name' => 'AUTO KUCA-KOLE DOO',
                    'companyCode' => 'CLIDOM2016101471048'
                ],
                [
                    'id' => new Id(),
                    'name' => 'SZR BOKI LIMAR',
                    'companyCode' => 'CLIDOM2020243232232'
                ]
            ];
    }
}
