<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration\Documentation;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyRegDocumentationCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $docId;

    /**
     * @var string
     */
    private $registrationId;


    public function __construct($docId, $registrationId)
    {
        $this->docId = $docId;
        $this->registrationId = $registrationId;
    }

    /**
     * Get the value of docId
     *
     * @return  string
     */
    public function getDocId()
    {
        return $this->docId;
    }

    /**
     * Get the value of registrationId
     *
     * @return  string
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }
}
