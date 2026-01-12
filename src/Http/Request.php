<?php

namespace App\Http;

use App\Http\Response;

class Request
{
    public function __construct(
        public string $method,
        public string $uri,
        public array $headers = [],
        public array $body = []
    ) {}
}