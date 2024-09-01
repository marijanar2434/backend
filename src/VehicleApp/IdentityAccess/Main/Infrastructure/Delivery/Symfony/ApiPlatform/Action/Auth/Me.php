<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\Auth;

use App\Common\Application\Bus\QueryBus;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\VehicleApp\IdentityAccess\Main\Application\Query\Auth\MeQuery;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity\UserDto;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Auth\Me as MeModel;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;

class Me extends AbstractController
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @var Security
     */
    private $security;

    /**
     * Me Constructor
     *
     * @param QueryBus $queryBus
     * @param Security $security
     */
    public function __construct(QueryBus $queryBus, Security $security)
    {
        $this->queryBus = new ExceptionHandlingQueryBus($queryBus, new ExceptionHandler);
        $this->security = $security;
    }

    /**
     * @return MeModel|null
     */
    public function __invoke(): ?MeModel
    {
        /**
         * @var UserDto|null
         */
        $result = $this->queryBus
            ->handle(
                new MeQuery(empty($this->security->getUser()) ? '' : $this->security->getUser()->getUserIdentifier())
            )->getFirst();

        if (!empty($result)) {
            $user = new MeModel();
            $user->id = $result->getId();
            $user->fullName = $result->getFullName();
            $user->username = $result->getUsername();
            $user->email = $result->getEmail();
            $user->active = $result->getActive();
            $user->avatar = $result->getAvatar();
            return $user;
        }

        throw $this->createNotFoundException();
    }
}
