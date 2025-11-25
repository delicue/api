<?php

use Api\Router;
use Api\Database as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

DB::config(__DIR__ . '/../data/database.sqlite');

dd($db);
$router = new Router();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->get('/', function(): void {
    header('Content-Type: text/html');
    view('index');
});

$router->get('/users', function(): void {
    $apiKey = $_GET['apiKey'] ?? null;
    $db = DB::getInstance();

    if($apiKey && $db->isValidApiKey($apiKey)){
        header('Content-Type: application/json');
        echo json_encode($db->fetchAll("select * from users"));
    } else {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode(['403' => "Unauthorized"]);
    }
});

$router->dispatch($uri, $method);