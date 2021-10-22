<?php

namespace App\NodeTypes\TextTransformation;

use App\Abstracts\AbstractSchemaValidation;

class TextTransformationSchemaValidation extends AbstractSchemaValidation {
    protected array $schema = [
        'type' => 'array',
        'minItems' => 1,
        'items' => [
            'type' => 'object',
            'required' => ['column', 'transformation'],
            'properties' => [
                'column' => ['type' => 'string'],
                'transformation' => ['type' => 'string'],
            ]
        ],
    ];
}