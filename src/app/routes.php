<?php

use App\Database as DB;
use App\Log;
use App\Router;
use App\Session;

$router = new Router();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

function getView($uri): void {  
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

// API Routes
$router->get('/users', fn() => fetchApiJson('users'));
$router->get('/posts', fn() => fetchApiJson('posts'));

// Auth Routes
$router->get('/login', function(): void {
    view('login');
});
$router->post('/login', function() {
    // Read JSON input from raw POST data
    // $data = json_decode(file_get_contents('php://input'), true);
    $data = $_POST;
    Log::info("Received login request with data: " . json_encode($data));
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    Log::info("Login attempt for username: $username");
    Log::info("Password provided: " . ($password ? 'Yes' : 'No'));
    Log::info("Password length: " . strlen($password));

    $loginResult = Session::login($username, $password);
    echo $loginResult;
});
$router->get('/register', function(): void {
    view('register');
});
$router->post('/register', function(): void {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        Session::register($username, $password);
        header('Location: /');
        exit();
    } catch (Exception $e) {
        header('Content-Type: text/html');
        view('register', ['error' => $e->getMessage()]);
    }
});
$router->post('/logout', function(): void {
    Session::logout();
    header('Location: /');
    exit();
});
$router->post('/request-api-key', function(): void {
    $db = DB::getInstance();
    if($db->count('api_keys') >= 10){
        header('Content-Type: application/json');
        http_response_code(429);
        echo json_encode(['429' => "API Key distribution limit reached."]);
        return;
    }
    $newApiKey = bin2hex(random_bytes(16));
    $db->createApiKey($newApiKey);

    header('Content-Type: text/plain');
    echo $newApiKey;
});

$router->dispatch($uri, $method);