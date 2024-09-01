<?php

namespace App\Common\Application\Transformer;

interface ItemTransformer
{
    /**
     * @param mixed $entity
     *
     * @return void
     */
    public function write($entity): void;

    /**
     * @return mixed
     */
    public function read(): mixed;
}
