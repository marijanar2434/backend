<?php

namespace App\Common\Infrastructure\Service\Hasher;

class BcryptHasher implements Hasher
{
    /**
     * @inheritDoc
     */
    public function hash($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @inheritDoc
     */
    public function verify($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}
