<?php

namespace App\NodeTypes\Output;

use App\Abstracts\AbstractType;

class OutputNodeType extends AbstractType
{
    protected OutputTransformObject $transformObject;

    public function toQuery(): string
    {
        $table = $this->getPrevTableName();

        $columns = $this->getCloumns($this->getInputNodeType()->getTransformObject()->getFields());

        $limit = $this->transformObject->getLimit();

        $offset = $this->transformObject->getOffset();

        return sprintf("%s AS (SELECT `%s` FROM `%s` LIMIT %s OFFSET %s) SELECT * from %s", $this->getKey(), $columns, $table, $limit, $offset, $this->getKey());
    }
}