<?php


namespace App\Exceptions;

use Exception;
use Opis\JsonSchema\Errors\ErrorFormatter;
use Opis\JsonSchema\Errors\ValidationError;

class TransformObjectValidationException extends Exception
{
    public function __construct(ValidationError $error, string $key)
    {
        // Create an error formatter
        $formatter = new ErrorFormatter();

        $errorMessage = $formatter->formatKeyed($error);

        $message = sprintf('The schema format at node %s is invalid, Path: "%s", errorMessage: %s', $key, array_key_first($errorMessage), reset($errorMessage)[0]);

        parent::__construct($message, 400);
    }

    public function handleNestedErrors()
    {

    }
}