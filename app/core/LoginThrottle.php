<?php

class LoginThrottle
{
    private mysqli $db;
    private int $maxAttempts;
    private int $windowSeconds;
    private int $blockSeconds;

    public function __construct(
        mysqli $db,
        int $maxAttempts = 5,
        int $windowSeconds = 600,
        int $blockSeconds = 900
    ) {
        $this->db = $db;
        $this->maxAttempts = $maxAttempts;
        $this->windowSeconds = $windowSeconds;
        $this->blockSeconds = $blockSeconds;
    }

    public static function clientIp(): string
    {
        $ip = trim((string)($_SERVER['REMOTE_ADDR'] ?? ''));
        if ($ip === '') {
            return 'unknown';
        }

        if (strlen($ip) > 45) {
            return substr($ip, 0, 45);
        }

        return $ip;
    }

    public function isBlocked(string $ip, string $username): array
    {
        $row = $this->find($ip, $username);
        if (!$row || empty($row['blocked_until'])) {
            return ['blocked' => false, 'retry_after' => 0];
        }

        $blockedUntil = strtotime((string)$row['blocked_until']);
        $now = time();

        if ($blockedUntil === false || $blockedUntil <= $now) {
            return ['blocked' => false, 'retry_after' => 0];
        }

        return [
            'blocked' => true,
            'retry_after' => $blockedUntil - $now
        ];
    }

    public function registerFailure(string $ip, string $username): array
    {
        $now = time();
        $row = $this->find($ip, $username);

        if (!$row) {
            $this->insertFresh($ip, $username);
            return ['blocked' => false, 'retry_after' => 0, 'attempts' => 1];
        }

        $lastAttempt = strtotime((string)($row['last_attempt_at'] ?? '')) ?: 0;
        $attempts = (int)($row['attempts'] ?? 0);

        if (($now - $lastAttempt) > $this->windowSeconds) {
            $attempts = 1;
        } else {
            $attempts++;
        }

        $blockedUntil = null;
        if ($attempts >= $this->maxAttempts) {
            $blockedUntil = date('Y-m-d H:i:s', $now + $this->blockSeconds);
        }

        $this->update($ip, $username, $attempts, $blockedUntil);

        return [
            'blocked' => $blockedUntil !== null,
            'retry_after' => $blockedUntil !== null ? $this->blockSeconds : 0,
            'attempts' => $attempts
        ];
    }

    public function clear(string $ip, string $username): void
    {
        $stmt = $this->db->prepare(
            "DELETE FROM auth_login_attempts WHERE ip_address = ? AND username = ?"
        );
        $stmt->bind_param('ss', $ip, $username);
        $stmt->execute();
        $stmt->close();
    }

    private function find(string $ip, string $username): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT attempts, last_attempt_at, blocked_until
             FROM auth_login_attempts
             WHERE ip_address = ? AND username = ?
             LIMIT 1"
        );
        $stmt->bind_param('ss', $ip, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return $row ?: null;
    }

    private function insertFresh(string $ip, string $username): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO auth_login_attempts
             (ip_address, username, attempts, first_attempt_at, last_attempt_at, blocked_until)
             VALUES (?, ?, 1, NOW(), NOW(), NULL)"
        );
        $stmt->bind_param('ss', $ip, $username);
        $stmt->execute();
        $stmt->close();
    }

    private function update(string $ip, string $username, int $attempts, ?string $blockedUntil): void
    {
        $stmt = $this->db->prepare(
            "UPDATE auth_login_attempts
             SET attempts = ?, last_attempt_at = NOW(), blocked_until = ?
             WHERE ip_address = ? AND username = ?"
        );
        $stmt->bind_param('isss', $attempts, $blockedUntil, $ip, $username);
        $stmt->execute();
        $stmt->close();
    }
}
