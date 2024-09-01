<?php

namespace App;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Command\CommandHandler;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Common\Infrastructure\Delivery\Symfony\DependencyInjection\Compiler\DoctrineCompilerPass;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    protected function build(ContainerBuilder $container): void
    {
        $container
            ->registerForAutoconfiguration(CommandHandler::class)->addTag('messenger.message_handler', ['bus' => 'command.bus']);

        $container
            ->registerForAutoconfiguration(QueryHandler::class)->addTag('messenger.message_handler', ['bus' => 'query.bus']);

        $container->addCompilerPass(new DoctrineCompilerPass());
    }
}
