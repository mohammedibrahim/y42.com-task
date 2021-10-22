<?php

namespace App\Abstracts;

use App\Contracts\SchemaValidation;

abstract class AbstractSchemaValidation implements SchemaValidation
{
    protected array $schema;

    /**
     * @return array
     */
    public function getSchema(): array
    {
        return $this->schema;
    }
}