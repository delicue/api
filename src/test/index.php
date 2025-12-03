<?php

use Delique\Api\Router;
use Delique\Api\Database as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

DB::config('sqlite:' . __DIR__ . '/../data/database.sqlite');

$router = new Router();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->get('/', function(): void {
    header('Content-Type: text/html');
    view('index');
});

function fetchApiJson($table): void {
    $apiKey = $_GET['apiKey'] ?? null;
    $db = DB::getInstance();

    if($apiKey && $db->isValidApiKey($apiKey)){
        header('Content-Type: application/json');
        echo json_encode($db->fetchAll("select * from {$table}"));
    } else {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode(['403' => "Unauthorized"]);
    }
}

$router->get('/users', fn() => fetchApiJson('users'));
$router->get('/posts', fn() => fetchApiJson('posts'));

$router->post('/request-api-key', function(): void {
    $db = DB::getInstance();
    $newApiKey = bin2hex(random_bytes(16));
    $db->createApiKey($newApiKey);

    header('Content-Type: application/json');
    echo json_encode(['apiKey' => $newApiKey]);
});

$router->dispatch($uri, $method);