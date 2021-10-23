<?php

namespace App\NodeTypes;

use App\Contracts\NodeTypeContract;
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
        $dataObj = [];

        $res = [];

        foreach ($data['edges'] as $edge) {
            ['from' => $from, 'to' => $to] = $edge;

            if (empty($dataObj[$from])) {
                $dataObj[$from] = $this->getNodeByKey($from, $data['nodes'], NULL);
                $res[] = $dataObj[$from]->toQuery();
            }

            $dataObj[$to] = $this->getNodeByKey($to, $data['nodes'], $dataObj[$from]);

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

        return $this->ioc->make('NodeType', $data);
    }
}