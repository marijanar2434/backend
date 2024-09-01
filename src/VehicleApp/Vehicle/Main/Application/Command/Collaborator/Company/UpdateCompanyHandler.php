<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Company;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CompanyNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;

class UpdateCompanyHandler implements CommandHandler
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

    public function __invoke(UpdateCompanyCommand $command)
    {

        /**
         * @var Company|null
         */
        $company = $this->companyRepository->findById(new Id($command->getId()));

        if (empty($company)) {
            throw new CompanyNotFoundException();
        }

        $company->updateProperties(
            $command->getName(),
            $command->getCompanyCode()
        );


        $this->companyRepository->save($company);
    }
}
