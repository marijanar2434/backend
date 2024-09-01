<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    /**
     * @return void
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
    }
}
