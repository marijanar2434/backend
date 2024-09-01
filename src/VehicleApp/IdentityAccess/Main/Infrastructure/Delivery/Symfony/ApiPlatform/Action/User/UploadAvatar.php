<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Action\User;

use App\Common\Application\Bus\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity\UserAvatarDto;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\Common\Infrastructure\Delivery\Symfony\HttpFoundation\RequestFileMover;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Identity\UploadUserAvatarCommand;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\User\Avatar;

class UploadAvatar extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var RequestFileMover
     */
    private $requestFileMover;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * UploadAvatar Constructor
     *
     * @param CommandBus $commandBus
     * @param RequestFileMover $requestFileMover
     * @param ValidatorInterface $validator
     */
    public function __construct(CommandBus $commandBus, RequestFileMover $requestFileMover, ValidatorInterface $validator)
    {
    
        $this->commandBus = new ExceptionHandlingCommandBus($commandBus, new ExceptionHandler);
        $this->requestFileMover = $requestFileMover;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * 
     * @return Avatar
     */
    public function __invoke(Request $request): Avatar
    {
        $avatar = new Avatar();
        if ($request->files->count() > 0 && $request->files->get('file') !== null) {
            $avatar->file = $this->requestFileMover->move($request->files->get('file'));
        }

        $this->validator->validate($avatar, ['groups' => ['create']]);

        /**
         * @var UserAvatarDto|null
         */
        $result = $this->commandBus
            ->handle(new UploadUserAvatarCommand($avatar->file->getRealPath()))
            ?->last(HandledStamp::class)
            ?->getResult();

        $avatar->url = $result?->getUrl();


        
        return $avatar;
    }
}
