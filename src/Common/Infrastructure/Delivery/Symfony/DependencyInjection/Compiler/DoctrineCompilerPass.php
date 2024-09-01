<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Delivery\Symfony\DependencyInjection\Compiler;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\TransactionIsolationLevel;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $container
            ->getDefinition('doctrine.dbal.default_connection')
            ->setConfigurator([self::class, 'setDefaultTransactionIsolationLevel']);
    }

    /**
     * @param Connection $connection
     * 
     * @return void
     */
    public static function setDefaultTransactionIsolationLevel(Connection $connection): void
    {
        if ($connection->isConnected()) {
            $connection->setTransactionIsolation(TransactionIsolationLevel::READ_COMMITTED);
        }
    }
}
