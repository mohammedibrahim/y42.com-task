<?php

namespace App;

use App\Response\Response;
use App\Services\SqLQueryTransformerService;
use Illuminate\Contracts\Container\Container;

class Bootstrap
{
    protected Response $response;

    protected SqLQueryTransformerService $sqLQueryTransformerService;

    public function __construct(Response $response, SqLQueryTransformerService $sqLQueryTransformerService)
    {
        $this->response = $response;

        $this->sqLQueryTransformerService = $sqLQueryTransformerService;
    }

    public function boot(array $data) :string
    {
        try{
            return $this->response->success($this->sqLQueryTransformerService->transform($data));
        }catch (\Exception $e){
            return $this->response->error($e->getMessage());
        }
    }
}