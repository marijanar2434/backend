<?php

namespace App\Common\Application\Bus;

use App\Common\Application\Command\Command;

interface CommandBus
{
    /**
     * @param Command $command
     *
     * @return mixed
     */
    public function handle($command): mixed;
}
