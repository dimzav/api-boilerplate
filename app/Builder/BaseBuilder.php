<?php

namespace App\Builder;

/**
 * Builder for repository.
 */
class BaseBuilder implements BuilderInterface
{
    /**
     * Associative array with structure: attribute_name => attribute_value.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Attributes can be set by param.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
