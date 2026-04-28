<?php

require_once BASE_PATH . '/app/core/SecurityLogger.php';

class ErrorHandler
{
    private static bool $debug = false;

    public static function init(bool $debug = false): void
    {
        self::$debug = $debug;

        if ($debug) {
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', '0');
            ini_set('display_startup_errors', '0');
            error_reporting(E_ALL);
        }

        set_error_handler([self::class, 'handlePhpError']);
        set_exception_handler([self::class, 'handleException']);
    }

    public static function handlePhpError(int $severity, string $message, string $file, int $line): bool
    {
        if (!(error_reporting() & $severity)) {
            return false;
        }

        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    public static function handleException(Throwable $exception): void
    {
        SecurityLogger::log('app.exception', [
            'type' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ], 'error');

        if (self::$debug) {
            http_response_code(500);
            echo '<h1>Application Error</h1>';
            echo '<pre>' . htmlspecialchars((string)$exception, ENT_QUOTES, 'UTF-8') . '</pre>';
            return;
        }

        http_response_code(500);
        $errorView = BASE_PATH . '/app/views/user/errors/500.php';
        if (is_file($errorView)) {
            require $errorView;
            return;
        }

        echo 'Terjadi kesalahan pada server.';
    }
}
