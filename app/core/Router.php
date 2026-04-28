<?php

// buat nunjukkin jalan dan ngejaga user dari akses yang gak diinginkan, misalnya user gak bisa akses halaman admin, dan sebaliknya
require_once BASE_PATH . '/app/core/SecurityLogger.php';

class Router
{
    private $routes = [];

    // REGISTER ROUTES
    public function get($path, $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post($path, $action)
    {
        $this->routes['POST'][$path] = $action;
    }

    // DISPATCH
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Hilangkan BASE_URL
        if (defined('BASE_URL') && BASE_URL !== '') {
            if (strpos($url, BASE_URL) === 0) {
                $url = substr($url, strlen(BASE_URL));
            }
        }

        $url = trim($url, '/');
        $url = $url === '' ? '/' : '/' . $url;

        $action = $this->routes[$method][$url] ?? null;

        if (!$action) {
            http_response_code(404);
            require_once BASE_PATH . '/app/views/user/errors/404.php';
            return;
        }

        list($controllerName, $methodAction) = explode('@', $action);

        $file = BASE_PATH . "/app/controllers/$controllerName.php";

        if (!file_exists($file)) {
            SecurityLogger::log('router.controller_missing', ['controller' => $controllerName], 'error');
            throw new RuntimeException('Terjadi kesalahan pada server.');
        }

        require_once $file;

        if (!class_exists($controllerName)) {
            SecurityLogger::log('router.class_missing', ['controller' => $controllerName], 'error');
            throw new RuntimeException('Terjadi kesalahan pada server.');
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodAction)) {
            SecurityLogger::log('router.method_missing', [
                'controller' => $controllerName,
                'method' => $methodAction
            ], 'error');
            throw new RuntimeException('Terjadi kesalahan pada server.');
        }

        $controller->$methodAction();
    }
}
