<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Company;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;

class CreateCompanyHandler implements CommandHandler
{
    /**
     * 
     *
     * @var CompanyRepository
     */
    private $companyRepository;



    public function __construct(
        CompanyRepository $companyRepository
    ) {
        $this->companyRepository = $companyRepository;
    }

    public function __invoke(CreateCompanyCommand $command)
    {

        $company = new Company(
            new Id($command->getId()),
            $command->getName(),
            $command->getCompanyCode()
        );

        $this->companyRepository->save($company);
    }
}
