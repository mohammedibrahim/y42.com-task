<?php


namespace App\NodeTypes\TextTransformation;


class TextTransformationTransformObject
{
    protected string $column;

    protected string $transformation;

    /**
     * TextTransformationTransformObject constructor.
     * @param string $column
     * @param string $transformation
     */
    public function __construct(string $column, string $transformation)
    {
        $this->column = $column;
        $this->transformation = $transformation;
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