<?php
class Router
{
    protected $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $base = dirname($_SERVER['SCRIPT_NAME']);
        $uri = str_replace($base, '', $uri);

        $uri = rtrim($uri, '/') ?: '/';

        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            [$controller, $method] = $this->routes[$method][$uri];
            $controllerInstance = new $controller;
            call_user_func([$controllerInstance, $method]);
        } else {
            http_response_code(404);
            echo "404 Not Found — no route for '$uri'";
        }
    }
}
