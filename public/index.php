<?php

use Api\ApiRouter;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

// $api = [
//     '/users' => $db->isValidApiKey('test') ? 'data/users.json' : null,
//     '/posts' => $db->isValidApiKey('test') ? 'data/posts.json' : null,
// ];

$routes = require __DIR__ . '/../routes.php';
$apiRouter = new ApiRouter();
$uri = $_SERVER['REQUEST_URI'];

// if (array_key_exists($uri, $routes)) {
//     header('Content-Type: text/html');
//     view($routes[$_SERVER['REQUEST_URI']]);

// }
// else {
    $apiRouter->get('/', function() {
        header('Content-Type: application/json');
        jsonData('users');
    });
// }
// else {
//     http_response_code(404);
// }