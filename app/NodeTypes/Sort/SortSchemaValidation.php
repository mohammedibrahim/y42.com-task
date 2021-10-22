<?php

namespace App\NodeTypes\Sort;

use App\Abstracts\AbstractSchemaValidation;

class SortSchemaValidation extends AbstractSchemaValidation {
    protected array $schema = [
        'type' => 'array',
        'minItems' => 1,
        'items' => [
            'type' => 'object',
            'required' => ['target', 'order'],
            'properties' => [
                'target' => ['type' => 'string'],
                'order' => ['type' => 'string'],
            ]
        ],
    ];
}