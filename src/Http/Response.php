<?php

namespace App\Http;

class Response
{
    public function __construct(
        public int $statusCode = 200,
        public array $headers = [],
        public public(set) string $body = ''
    ) {}

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
        echo $this->body;
    }
}