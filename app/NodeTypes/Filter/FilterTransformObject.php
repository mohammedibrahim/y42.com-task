<?php

namespace App\NodeTypes\Filter;

use App\Abstracts\AbstractTransformObject;

class FilterTransformObject extends AbstractTransformObject
{
    protected string $variableFieldName;

    protected string $joinOperator;

    /**
     * @var FilterOperation[]
     */
    protected array $operations;

    /**
     * FilterTransformObject constructor.
     * @param string $variableFieldName
     * @param string $joinOperator
     * @param FilterOperation[] $operations
     */
    public function __construct(string $variableFieldName, string $joinOperator, array $operations)
    {
        $this->variableFieldName = $variableFieldName;
        $this->joinOperator = $joinOperator;
        $this->operations = $operations;
    }

    /**
     * @return string
     */
    public function getVariableFieldName(): string
    {
        return $this->variableFieldName;
    }

    /**
     * @return string
     */
    public function getJoinOperator(): string
    {
        return $this->joinOperator;
    }

    /**
     * @return FilterOperation[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}