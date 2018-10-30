<?php

namespace App\Builder;

interface BuilderInterface
{
    /**
     * Returns all attributes.
     *
     * @return array
     */
    public function getAttributes(): array;
}
