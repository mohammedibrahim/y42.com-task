<?php

namespace App\Abstracts;

use App\Contracts\SchemaValidationContract;

abstract class AbstractSchemaValidation implements SchemaValidationContract
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