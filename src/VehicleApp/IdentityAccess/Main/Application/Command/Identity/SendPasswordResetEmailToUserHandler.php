<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Domain\ValueObject\Id;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use App\Common\Application\Command\CommandHandler;
use Symfony\Component\Mime\Address as MimeAddress;
use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserDidNotRequestedPasswordResetException;

class SendPasswordResetEmailToUserHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ItemTransformer
     */
    private $itemTransformer;

    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * UserPasswordResetCommandedListener Constructor
     *
     * @param UserRepository $userRepository
     * @param ItemTransformer $itemTransformer
     * @param ServerConfiguration $serverConfiguration
     * @param MailerInterface $mailer
     */
    public function __construct(UserRepository $userRepository, ItemTransformer $itemTransformer, ServerConfiguration $serverConfiguration, MailerInterface $mailer)
    {
        $this->userRepository = $userRepository;
        $this->itemTransformer = $itemTransformer;
        $this->serverConfiguration = $serverConfiguration;
        $this->mailer = $mailer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(SendPasswordResetEmailToUserCommand $command)
    {
        /**
         * @var User|null
         */
        $user = $this->userRepository->findById(new Id($command->getUserId()));

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        if (!$user->hasRequestedPasswordReset()) {
            throw new UserDidNotRequestedPasswordResetException();
        }

        $this->itemTransformer->write($user);

        $userPasswordResetLink = $this->serverConfiguration->generateUrl(
            '/api/identity-access/auth/password-reset',
            [
                'passwordRequestId' => $user->getPasswordResetRequest()->getId(),
                'userId' => $user->getId()->getId(),
            ]
        );

        $email = (new TemplatedEmail())
            ->from(new MimeAddress(
                $this->serverConfiguration->getEnv('MAILER_FROM'),
                $this->serverConfiguration->getEnv('MAILER_FROM_NAME')
            ))
            ->to(new MimeAddress(
                $user->getEmail(),
                $user->getFullName()
            ))
            ->subject(
                'Vehicle App - Password Reset'
            )
            ->htmlTemplate('/Email/User/password-reset.html.twig')
            ->context([
                'name' => $user->getFullName(),
                'userPasswordResetLink' => $userPasswordResetLink
            ]);

        $this->mailer->send($email);
    }
}
