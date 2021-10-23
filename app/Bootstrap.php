<?php

namespace App;

use App\Response\Response;
use App\Services\SqLQueryTransformerService;

class Bootstrap
{
    public function __construct(
        protected Response $response,
        protected SqLQueryTransformerService $sqLQueryTransformerService,
    )
    {
    }

    public function boot(array $data): string
    {
        try {
            return $this->response->success($this->sqLQueryTransformerService->transform($data));
        } catch (\Exception $e) {
            return $this->response->error($e->getMessage());
        }
    }
}