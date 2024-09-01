<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Company;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CompanyIsAttachedToCollaboratorException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CompanyNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Company\CompanyIsAttachedToCollaborators;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Company\CompanyDestroyer;

class DestroyCompanyHandler implements CommandHandler
{

    /**
     * 
     *
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * 
     *
     * @var CompanyDestroyer
     */
    private $companyDestroyer;


    /**
     * 
     *
     * @param CompanyRepository $companyRepository
     * @param CompanyDestroyer $companyDestroyer
     */
    public function __construct(CompanyRepository $companyRepository, CompanyDestroyer $companyDestroyer)
    {
        $this->companyRepository = $companyRepository;
        $this->companyDestroyer = $companyDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyCompanyCommand $command)
    {
        /**
         * @var Company|null
         */
        $company = $this->companyRepository->findById(new Id($command->getId()));

        if (empty($company)) {
            throw new CompanyNotFoundException();
        }

        try {   
            $this->companyDestroyer->destroy($company);
        } catch (CompanyIsAttachedToCollaborators) {
            throw new CompanyIsAttachedToCollaboratorException();
        }


       
    }
}


