<?php

namespace App\NodeTypes\Filter;

use App\Abstracts\AbstractSchemaValidation;

class FilterSchemaValidation extends AbstractSchemaValidation {
    protected array $schema = [
        'type' => 'object',
        'properties' => [
            'variableFieldName' => ['type' => 'string'],
            'joinOperator' => ['type' => 'string'],
            'operations' => [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'operator' => ['type' => 'string'],
                        'value' => ['type' => 'string'],
                    ]
                ]],
        ],
            'required' => ['variableFieldName', 'joinOperator', 'operations'],
    ];

}