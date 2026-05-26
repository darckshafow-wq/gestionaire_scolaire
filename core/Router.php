<?php

class Router {
    protected $routes = [];

    public function add($route, $controllerAction) {
        $this->routes[$route] = $controllerAction;
    }

    public function dispatch($url) {
        $url = parse_url($url, PHP_URL_PATH);
        if (array_key_exists($url, $this->routes)) {
            $parts = explode('@', $this->routes[$url]);
            $controllerName = $parts[0];
            $actionName = $parts[1];

            require_once ROOT_PATH . '/app/controllers/' . $controllerName . '.php';
            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            echo "404 Not Found";
        }
    }
}
