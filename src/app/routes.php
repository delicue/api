<?php

use App\Database as DB;
use App\Router;

$router = new Router();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

function getView($uri) {  
    global $router;
    $router?->get($uri, function() use (&$uri): void {
        header('Content-Type: text/html');
        view(str_replace('/', '', $uri) ?: 'index');
    });
}
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

// Normal Routes
// getView('/');
// getView('/test');

// Normal Routes
$router->get('/', function(): void {
    header('Content-Type: text/html');
    view('index');
});
$router->get('/test', function(): void {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'This is a test page.']);
});
// API Routes
$router->get('/users', fn() => fetchApiJson('users'));
$router->get('/posts', fn() => fetchApiJson('posts'));
$router->post('/request-api-key', function(): void {
    $db = DB::getInstance();
    $newApiKey = bin2hex(random_bytes(16));
    $db->createApiKey($newApiKey);

    header('Content-Type: text/plain');
    echo $newApiKey;
});

$router->dispatch($uri, $method);