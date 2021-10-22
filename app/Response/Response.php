<?php

namespace App\Response;

class Response
{
    public function success($data)
    {
        return json_encode(['success' => $data], JSON_PRETTY_PRINT);
    }

    public function error($data)
    {
        return json_encode(['error' => $data], JSON_PRETTY_PRINT);
    }
}