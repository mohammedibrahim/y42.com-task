<?php

namespace App\Abstracts;

use App\Contracts\NodeTypeContract;
use App\Contracts\TransformObjectContract;
use App\NodeTypes\Input\InputNodeType;

abstract class AbstractType implements NodeTypeContract
{
    protected InputNodeType $inputNodeType;

    /**
     * AbstractType constructor.
     * @param string $type
     * @param string $key
     * @param NodeTypeContract | NULL $prevNode
     * @param TransformObjectContract $transformObject
     */
    public function __construct(
        protected string $type,
        protected string $key,
        protected NodeTypeContract|null $prevNode,
        TransformObjectContract $transformObject
    )
    {
        if ($prevNode) {
            if (get_class($prevNode) === InputNodeType::class) {
                $this->inputNodeType = $prevNode;
            } else {
                $this->inputNodeType = $prevNode->getInputNodeType();
            }
        }

        $this->transformObject = $transformObject;
    }

    /**
     * @return InputNodeType
     */
    public function getInputNodeType(): InputNodeType
    {
        return $this->inputNodeType;
    }

    /**
     * @return NodeTypeContract | NULL
     */
    public function getPrevNode(): NodeTypeContract|null
    {
        return $this->prevNode;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return TransformObjectContract
     */
    public function getTransformObject(): TransformObjectContract
    {
        return $this->transformObject;
    }

    /**
     * Return the name of key of the previous query.
     *
     * @return string
     */
    protected function getPrevTableName(): string
    {
        return $this->prevNode->getKey();
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    protected function getCloumns($columns): string
    {
        $columns = implode('`, `', $columns);

        return $columns;
    }
}