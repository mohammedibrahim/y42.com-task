<?php

namespace App\NodeTypes\Filter;

use App\Abstracts\AbstractTransformObject;

class FilterTransformObject extends AbstractTransformObject
{
    /**
     * FilterTransformObject constructor.
     * @param string $variableFieldName
     * @param string $joinOperator
     * @param array $operations
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
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}