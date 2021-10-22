<?php

namespace App\NodeTypes\Output;

use App\Abstracts\AbstractSchemaValidation;

class OutputSchemaValidation extends AbstractSchemaValidation
{
    protected array $schema = [
        'type' => 'object',
        'properties' => [
            'limit' => ['type' => 'number'],
            'offset' => ['type' => 'number'],
        ],
        'required' => ['limit', 'offset'],
    ];
}