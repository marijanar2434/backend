<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Company;

use App\VehicleApp\Vehicle\Main\Domain\Exception\Company\CompanyIsAttachedToCollaborators;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;

class CompanyDestroyer
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
     * @var CollaboratorRepository
     */
    private  $collaboratorRepository;


    /**
     * 
     *
     * @param CompanyRepository $companyRepository
     * @param CollaboratorRepository $collaboratorRepository
     */
    public function __construct(CompanyRepository $companyRepository, CollaboratorRepository $collaboratorRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * 
     *
     * @param Company $company
     * @return void
     */
    public function destroy(Company $company): void
    {
        $res = $this->collaboratorRepository->countByCompanytId($company->getId());
        if ($res > 0) {
            throw new CompanyIsAttachedToCollaborators();
        }

        $this->companyRepository->remove($company);
    }
}
