<?php

namespace App\Validation;

use App\Contracts\SchemaValidationContract;
use App\Exceptions\TransformObjectValidationException;
use Illuminate\Contracts\Container\Container;
use Opis\JsonSchema\Helper;
use Opis\JsonSchema\Validator;

class SchemaValidation
{
    public function __construct(
        protected Container $ioc,
        protected Validator $validator
    )
    {
    }

    public function validateRequest($type, $result): bool
    {
        $schema = Helper::toJSON($this->ioc->make(SchemaValidationContract::class, ['type' => $type])->getSchema());

        $validationResult = $this->validator->validate(Helper::toJSON($result), $schema);

        if ($validationResult->hasError()) {
            throw new TransformObjectValidationException($validationResult->error(), 'Request Schema');
        }

        return $validationResult->isValid();
    }

    public function validate($type, $result): bool
    {
        $schema = Helper::toJSON($this->ioc->make(SchemaValidationContract::class, ['type' => $type])->getSchema());

        ['transformObject' => $transformObject, 'key' => $key] = $result;

        $validationResult = $this->validator->validate(Helper::toJSON($transformObject), $schema);

        if ($validationResult->hasError()) {
            throw new TransformObjectValidationException($validationResult->error(), $key);
        }

        return $validationResult->isValid();
    }
}