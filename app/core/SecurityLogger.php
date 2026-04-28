<?php

class SecurityLogger
{
    public static function log(string $event, array $context = [], string $level = 'warning'): void
    {
        $logDir = BASE_PATH . '/storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $record = [
            'time' => date('c'),
            'level' => $level,
            'event' => $event,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
            'uri' => $_SERVER['REQUEST_URI'] ?? '-',
            'context' => $context,
        ];

        $line = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($line === false) {
            $line = '{"time":"' . date('c') . '","level":"error","event":"security_log_encode_failed"}';
        }

        file_put_contents(
            $logDir . '/security-' . date('Y-m-d') . '.log',
            $line . PHP_EOL,
            FILE_APPEND
        );
    }
}
