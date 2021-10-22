<?php

namespace App\NodeTypes\Input;

use App\Abstracts\AbstractSchemaValidation;

class InputSchemaValidation extends AbstractSchemaValidation
{
    protected array $schema = [
        'type' => 'object',
        'properties' => [
            'tableName' => ['type' => 'string'],
            'fields' => ['type' => 'array', 'items' => [
                'type' => 'string',
                'minimum' => 1,
            ]],
        ],
        'required' => ['tableName', 'fields'],
    ];
}