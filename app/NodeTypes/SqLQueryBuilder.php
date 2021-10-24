<?php

namespace App\NodeTypes;

use App\Contracts\NodeTypeContract;
use App\NodeTypes\Input\InputNodeType;
use App\NodeTypes\Input\InputTransformObject;
use App\Validation\SchemaValidation;
use Illuminate\Contracts\Container\Container;

class SqLQueryBuilder
{
    public function __construct(
        protected Container $ioc,
        protected SchemaValidation $validator
    )
    {
    }

    public function build(array $data): string
    {
        ['nodes' => $nodes, 'edges' => $edges ]  = $data;
        $inputType = $this->getInputNodeType($nodes);

        $dataObj[$inputType->getKey()] = $this->getInputNodeType($nodes);

        $res[] = $inputType->toQuery();

        foreach ($edges as $edge) {

            ['from' => $from, 'to' => $to] = $edge;

            $dataObj[$to] = $this->getNodeByKey($to, $nodes, $dataObj[$from]);

            $res[] = $dataObj[$to]->toQuery();
        }

        return implode(',', $res);
    }

    protected function getNodeByKey($key, $nodes, $prevNode): NodeTypeContract
    {
        $result = array_filter($nodes, function ($node) use ($key) {
            return $key === $node['key'];
        });

        ['type' => $type] = end($result);

        $this->validator->validate($type, end($result));

        $data = end($result);

        $data['prevNode'] = $prevNode;

        return $this->ioc->make(NODE_TYPE, $data);
    }

    protected function getInputNodeType($nodes): NodeTypeContract
    {
        $result = array_filter($nodes, function ($node) {
            return InputNodeType::TYPE_NAME === $node['type'];
        });

        $this->validator->validate(InputNodeType::TYPE_NAME, end($result));

        $data = end($result);

        return $this->ioc->make(NODE_TYPE, $data);
    }
}