<?php

namespace App\Validation;

use App\Abstracts\AbstractSchemaValidation;

class RequestSchemaValidation extends AbstractSchemaValidation
{
    protected array $schema = [
        'type' => 'object',
        'properties' => [
            'nodes' => [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'key' => ['type' => 'string'],
                        'type' => ['type' => 'string'],
                        'transformObject' => ['type' => ['object', 'array']],
                    ]
                ]
            ],
            'edges' => [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'from' => ['type' => 'string'],
                        'to' => ['type' => 'string'],
                    ]
                ]
            ],
        ],
        'required' => ['nodes', 'edges'],
    ];

}