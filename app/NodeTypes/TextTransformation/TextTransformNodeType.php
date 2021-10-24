<?php

namespace App\NodeTypes\TextTransformation;

use App\Abstracts\AbstractType;

class TextTransformNodeType extends AbstractType
{
    const TYPE_NAME = 'TEXT_TRANSFORMATION';

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
                if($field->getColumn() === $column){
                    $newColumns[] = "{$field->getTransformation()}(`{$field->getColumn()}`) as `$column`";
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