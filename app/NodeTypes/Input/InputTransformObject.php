<?php

namespace App\NodeTypes\Input;

use App\Abstracts\AbstractTransformObject;

class InputTransformObject extends AbstractTransformObject
{
    protected string $tableName;

    protected array $fields;

    /**
     * InputTransformObject constructor.
     * @param string $tableName
     * @param array $fields
     */
    public function __construct(string $tableName, array $fields)
    {
        $this->tableName = $tableName;
        $this->fields = $fields;
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