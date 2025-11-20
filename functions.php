<?php

function view(string $viewPath, array $data = []): void
{
    extract($data);
    require __DIR__ . "/src/views/{$viewPath}.view.php";
}

function jsonData(string $path)
{
    require __DIR__ . "{$path}.json";
}