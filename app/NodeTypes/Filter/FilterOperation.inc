<?php


namespace App\NodeTypes\Filter;

class FilterOperation
{
    protected string $operator;
    protected string $value;

    /**
     * FilterOperation constructor.
     * @param string $operator
     * @param string $value
     */
    public function __construct(string $operator, string $value)
    {
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

}