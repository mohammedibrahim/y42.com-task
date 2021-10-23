<?php

namespace App\NodeTypes\Sort;

class SortTransformObject
{
    /**
     * SortTransformObject constructor.
     * @param string $target
     * @param string $order
     */
    public function __construct(
        protected string $target,
        protected string $order
    )
    {
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }
}