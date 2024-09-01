<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Bus\Exception;

use Symfony\Component\Messenger\Exception\RuntimeException;

class UnauthorizedExecutionException extends RuntimeException
{
}
