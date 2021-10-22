<?php

namespace App\NodeTypes\TextTransformation;

use App\Abstracts\AbstractType;

class TextTransformNodeType extends AbstractType
{
    protected TextTransformationTransformObjectCollection $transformObject;

    public function toQuery(): string
    {
        $table = $this->getPrevTableName();

        $columns = $this->getCloumns($this->getInputNodeType()->getTransformObject()->getFields());

        return sprintf("%s AS (SELECT %s FROM `%s`)", $this->getKey(), $columns, $table);
    }

    protected function getCloumns($columns): string
    {
        $fields = $this->transformObject->getItems();
        $newColumns = [];
        foreach ($columns as $column){
            $added = false;
            foreach ($fields as $field){
                if($field['column'] === $column){
                    $newColumns[] = "{$field['transformation']}(`{$field['column']}`) as `$column`";
                    $added = true;
                    break;
                }
            }

            if(!$added){
                $newColumns[] = "`$column`";
            }
        }

        return implode(', ', $newColumns);
    }
}