<?php

namespace App\Abstracts;

abstract class AbstractTransformObjectCollection extends AbstractTransformObject
{
    /**
     * SortTransformObjectCollection constructor.
     * @param $items
     */
    public function __construct(
        protected array $items
    )
    {
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}