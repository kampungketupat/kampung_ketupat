<?php

if (!function_exists('env_bool')) {
    function env_bool(string $key, bool $default = false): bool
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }

        $value = strtolower(trim((string)$value));
        return in_array($value, ['1', 'true', 'yes', 'on'], true);
    }
}

if (PHP_SAPI !== 'cli') {
    $appEnv = getenv('APP_ENV') ?: 'production';
    $forceHttps = env_bool('APP_FORCE_HTTPS', false);
    $isHttps = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

    if ($forceHttps && !$isHttps && !headers_sent()) {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        header('Location: https://' . $host . $uri, true, 301);
        exit;
    }

    $secureCookie = $isHttps || $forceHttps;

    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Lax');
    if ($secureCookie) {
        ini_set('session.cookie_secure', '1');
    }

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $secureCookie,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}
session_start();

header_remove('X-Powered-By');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
header('X-Permitted-Cross-Domain-Policies: none');

define('BASE_PATH', dirname(__DIR__));
if (!defined('BASE_URL')) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $scriptDir = rtrim($scriptDir, '/');
    define('BASE_URL', $scriptDir === '' || $scriptDir === '/' ? '' : $scriptDir);
}
define('APP_DEBUG', env_bool('APP_DEBUG', false));

require_once BASE_PATH . '/app/core/ErrorHandler.php';
ErrorHandler::init(APP_DEBUG);
require_once BASE_PATH . '/app/core/Csrf.php';
csrf_token();

require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';

$router = new Router();

require_once BASE_PATH . '/routes/web.php';

try {
    $router->dispatch();
} catch (Throwable $e) {
    ErrorHandler::handleException($e);
}
