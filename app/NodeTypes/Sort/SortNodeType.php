<?php

namespace App\NodeTypes\Sort;

use App\Abstracts\AbstractType;

class SortNodeType extends AbstractType
{
    protected SortTransformObjectCollection $transformObject;

    public function toQuery(): string
    {
        $table = $this->getPrevTableName();

        $columns = $this->getCloumns($this->getInputNodeType()->getTransformObject()->getFields());

        $order = $this->getOrder();

        return sprintf("%s AS (SELECT `%s` FROM %s ORDER BY %s)", $this->getKey(), $columns, $table, $order);
    }

    protected function getOrder()
    {
        $output = [];

        foreach ($this->transformObject->getItems() as $orderItem){
            $output[] = "`{$orderItem['target']}` {$orderItem['order']}";
        }

        return implode(", ", $output);
    }
}