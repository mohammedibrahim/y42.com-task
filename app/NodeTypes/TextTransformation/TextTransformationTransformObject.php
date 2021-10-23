<?php

namespace App\NodeTypes\TextTransformation;

class TextTransformationTransformObject
{
    /**
     * TextTransformationTransformObject constructor.
     * @param string $column
     * @param string $transformation
     */
    public function __construct(
        protected string $column,
        protected string $transformation
    )
    {
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return string
     */
    public function getTransformation(): string
    {
        return $this->transformation;
    }
}