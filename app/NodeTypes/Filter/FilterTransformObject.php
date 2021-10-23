<?php

namespace App\NodeTypes\Filter;

use App\Abstracts\AbstractTransformObject;

class FilterTransformObject extends AbstractTransformObject
{
    /**
     * FilterTransformObject constructor.
     * @param string $variableFieldName
     * @param string $joinOperator
     * @param FilterOperation[] $operations
     */
    public function __construct(
        protected string $variableFieldName,
        protected string $joinOperator,
        protected array $operations
    )
    {
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