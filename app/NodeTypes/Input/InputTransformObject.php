<?php

namespace App\NodeTypes\Input;

use App\Abstracts\AbstractTransformObject;

class InputTransformObject extends AbstractTransformObject
{
    /**
     * InputTransformObject constructor.
     * @param string $tableName
     * @param array $fields
     */
    public function __construct(
        protected string $tableName,
        protected array $fields
    )
    {
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}