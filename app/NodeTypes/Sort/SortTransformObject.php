<?php

namespace App\NodeTypes\Sort;

class SortTransformObject
{
    protected string $target;

    protected string $order;

    /**
     * SortTransformObject constructor.
     * @param string $target
     * @param string $order
     */
    public function __construct(string $target, string $order)
    {
        $this->target = $target;
        $this->order = $order;
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