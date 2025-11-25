<?php 

namespace Api;

class Router {
    protected array $routes = [];
    protected array $routeData = [];

    public function getRoutes(): array {
        return $this->routes;
    }

    public function register($uri, $method, $action, array $data = []): void {
        $this->routes[$method][$uri] = $action;
        $this->routeData[$uri] = $data;
    }

    public function get($uri, $action, $data = []): void {
        $this->register($uri, 'GET', $action, $data);
    }

    public function post($uri, $action, $data = []): void {
        $this->register($uri, 'POST', $action, $data);
    }

    /**
     * 
     * @param mixed $uri The request URI
     * @param mixed $method The HTTP method (GET, POST, etc.)
     */
    public function dispatch($uri, $method): ?string {
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            if (is_callable($action)) {
                return call_user_func($action, ...$this->routeData[$uri]);
            } elseif (is_string($action)) {
                [$controller, $method] = explode('@', $action);
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $method)) {
                        return call_user_func([$controllerInstance, $method]);
                    }
                }
            }
        }
        http_response_code(404);
        return view('index');
    }
}