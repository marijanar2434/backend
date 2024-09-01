<?php

namespace App\Common\Application\Bus;

interface EventBus
{
    /**
     * @param mixed $event
     *
     * @return mixed
     */
    public function handle($event): mixed;
}
