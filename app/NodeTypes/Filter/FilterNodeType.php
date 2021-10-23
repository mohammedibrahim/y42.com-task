<?php

namespace App\NodeTypes\Filter;

use App\Abstracts\AbstractType;

class FilterNodeType extends AbstractType
{
    protected FilterTransformObject $transformObject;

    public function toQuery(): string
    {
        $table = $this->getPrevTableName();

        $columns = $this->getCloumns($this->getInputNodeType()->getTransformObject()->getFields());

        $whereCondition = $this->getWhereCondition();

        return sprintf("%s AS (SELECT `%s` FROM %s WHERE %s)", $this->getKey(), $columns, $table, $whereCondition);
    }

    protected function getWhereCondition(): string
    {
        $filedName = $this->transformObject->getVariableFieldName();

        $response = [];

        foreach ($this->transformObject->getOperations() as $operation){
            $response[] = "$filedName {$operation->getOperator()} {$operation->getValue()}";
        }

        return implode(" ".$this->transformObject->getJoinOperator(). " " ,$response);
    }
}