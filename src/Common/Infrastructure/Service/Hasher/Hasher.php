<?php

namespace App\Common\Infrastructure\Service\Hasher;

interface Hasher
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function hash($value): string;

    /**
     * @param string $value
     * @param string $hash
     *
     * @return boolean
     */
    public function verify($value, $hash): bool;
}
