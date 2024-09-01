<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Documentation;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;

class RegDocumentation extends Entity
{
    /**
     * @var File
     */
    private  $file;


    /**
     * 
     *
     * @var Registration
     */
    private  $registration;

    public function __construct(Id $id, Registration $registration, File $file)
    {
        parent::__construct($id);

        $this->setFile($file);
        $this->setRegistration($registration);
    }

    /**
     * Get the value of file
     *
     * @return  File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @param  File  $file
     *
     * @return  self
     */
    public function setFile(File $file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get the value of registration
     *
     * @return  Registration
     */ 
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * Set the value of registration
     *
     * @param  Registration  $registration
     *
     * @return  self
     */ 
    public function setRegistration(Registration $registration)
    {
        $this->registration = $registration;
        return $this;
    }
}
