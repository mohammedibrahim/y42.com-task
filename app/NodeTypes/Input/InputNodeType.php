<?php

namespace App\NodeTypes\Input;

use App\Abstracts\AbstractType;

class InputNodeType extends AbstractType
{
    const TYPE_NAME = 'INPUT';

    protected InputTransformObject $transformObject;

    public function toQuery(): string
    {
        $columns = implode('`,`', $this->transformObject->getFields());

        $tableName = $this->transformObject->getTableName();

        return sprintf("WITH %s AS (SELECT `%s` FROM `%s`)", $this->getKey(), $columns, $tableName);
    }
}