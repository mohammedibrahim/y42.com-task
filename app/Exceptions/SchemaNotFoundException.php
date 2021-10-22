<?php

namespace App\Exceptions;

use Exception;

class SchemaNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('The given type does not have a validation schema', 500);
    }
}