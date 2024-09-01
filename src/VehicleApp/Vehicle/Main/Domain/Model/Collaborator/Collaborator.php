<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use Doctrine\Common\Collections\ArrayCollection;

class Collaborator extends Entity
{
    /**
     * 
     *
     * @var Client
     */
    private  $client;

    /**
     * 
     *
     * @var ArrayCollection<CollabType>
     */
    private  $types;

    /**
     * 
     *
     * @var Company
     */
    private  $company;

    public function __construct(Id $id, Client $client, Company $company, array $types = [])
    {
        parent::__construct($id);

        $this->setClient($client);
        $this->setTypes($types);
        $this->setCompany($company);
    }


    public function updateProperties(Client $client, Company $company)
    {
        $this->setClient($client);
        $this->setCompany($company);
    }



    /**
     * Get the value of client
     *
     * @return  Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @param  Client  $client
     *
     * @return  self
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get the value of types
     *
     * @return  CollabType[]
     */
    public function getTypes(): array
    {
        return $this->types->toArray();
    }

    /**
     * Set the value of types
     *
     * @param  CollabType[]  $types
     *
     * @return  self
     */
    public function setTypes(array $types)
    {
        $this->types = new ArrayCollection($types);
        return $this;
    }

    /**
     * Get the value of company
     *
     * @return  Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @param  Company  $company
     *
     * @return  self
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }
}
