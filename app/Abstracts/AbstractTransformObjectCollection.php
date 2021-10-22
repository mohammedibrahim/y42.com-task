<?php

namespace App\Abstracts;

abstract class AbstractTransformObjectCollection extends AbstractTransformObject
{
    protected array $items;

    /**
     * SortTransformObjectCollection constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}