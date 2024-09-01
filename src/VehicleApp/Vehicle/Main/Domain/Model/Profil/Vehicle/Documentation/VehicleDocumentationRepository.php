<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Documentation;

use App\Common\Domain\Repository;

interface VehicleDocumentationRepository extends Repository
{

    public function findByName(string $name): ?VehicleDocumentation;
    
}

