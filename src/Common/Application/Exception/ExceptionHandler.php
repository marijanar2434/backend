<?php

namespace App\Common\Application\Exception;

use Throwable;

interface ExceptionHandler
{
    /**
     * @param Throwable $e
     *
     * @return void
     */
    public function handle(Throwable $e): void;
}
