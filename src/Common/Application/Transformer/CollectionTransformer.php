<?php

namespace App\Common\Application\Transformer;

interface CollectionTransformer
{
    /**
     * @param array $entities
     *
     * @return void
     */
    public function write($entities): void;

    /**
     * @return array|mixed
     */
    public function read(): mixed;
}
