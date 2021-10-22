<?php

namespace App\Exceptions;

use Exception;

class NodeTypeNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('The given type does not have a node type.', 500);
    }
}