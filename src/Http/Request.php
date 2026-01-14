<?php

namespace App\Http;

use App\Http\Response;

enum REQUEST_BODY_TYPE: string 
{
    case JSON = 'json';
    case FORM = 'form';
    case RAW = 'raw';
}

class Request
{
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function uri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    public function headers(): array
    {
        return getallheaders();
    }

    /**
     * Get the request body based on the specified type.
     * @param REQUEST_BODY_TYPE $type The type of the request body to retrieve.
     * @return array|string The request body as an associative array for JSON and FORM types, or as a raw string for RAW type.
     */
    public function body(REQUEST_BODY_TYPE $type = REQUEST_BODY_TYPE::JSON): array|string
    {
        return match ($type) {
            REQUEST_BODY_TYPE::JSON => json_decode(file_get_contents('php://input'), true) ?? [],
            REQUEST_BODY_TYPE::FORM => $_POST,
            REQUEST_BODY_TYPE::RAW => file_get_contents('php://input'),
            default => [],
        };
    }
}