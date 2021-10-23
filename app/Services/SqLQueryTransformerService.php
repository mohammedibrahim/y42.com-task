<?php

namespace App\Services;

use App\NodeTypes\SqLQueryBuilder;
use App\Validation\SchemaValidation;
use Symfony\Component\Serializer\Serializer;

class SqLQueryTransformerService
{
    public function __construct(
        protected Serializer $serializer,
        protected SchemaValidation $validator,
        protected SqLQueryBuilder $sqlQueryBuilder,
    )
    {
    }

    public function transform(array $data): string
    {
        $this->validator->validateRequest('REQUEST_SCHEMA', $data);

        return $this->sqlQueryBuilder->build($data);
    }
}