<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler, array $meta = []): void
    {
        $this->add('GET', $path, $handler, $meta);
    }

    public function post(string $path, array $handler, array $meta = []): void
    {
        $this->add('POST', $path, $handler, $meta);
    }

    private function add(string $method, string $path, array $handler, array $meta): void
    {
        $this->routes[$method][$path] = ['handler' => $handler, 'meta' => $meta];
    }

    public function dispatch(string $method, string $uri): void
    {
        $route = $this->routes[$method][$uri] ?? null;
        if (!$route) {
            http_response_code(404);
            echo 'Página no encontrada';
            return;
        }

        if (($route['meta']['auth'] ?? false) === true) {
            require_auth();
        }

        if (!empty($route['meta']['permission'])) {
            require_permission($route['meta']['permission']);
        }

        [$controller, $action] = $route['handler'];
        (new $controller())->$action();
    }
}
