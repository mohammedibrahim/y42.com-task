<?php

namespace App\Contracts;

interface NodeTypeContract
{
    public function toQuery(): string;
}