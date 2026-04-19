<?php

declare(strict_types=1);

if (!function_exists('env')) {
    function env(string $key, ?string $default = null): ?string
    {
        static $loaded = false;
        if (!$loaded) {
            $envPath = BASE_PATH . '/.env';
            if (file_exists($envPath)) {
                $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
                        continue;
                    }
                    [$k, $v] = explode('=', $line, 2);
                    $_ENV[trim($k)] = trim(trim($v), "\"'");
                }
            }
            $loaded = true;
        }

        return $_ENV[$key] ?? $default;
    }
}

function config(string $key): mixed
{
    [$file, $item] = explode('.', $key, 2);
    static $cache = [];
    if (!isset($cache[$file])) {
        $cache[$file] = require BASE_PATH . '/config/' . $file . '.php';
    }

    return $cache[$file][$item] ?? null;
}

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $cfg = require BASE_PATH . '/config/database.php';
    $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', $cfg['driver'], $cfg['host'], $cfg['port'], $cfg['database'], $cfg['charset']);
    $pdo = new PDO($dsn, $cfg['username'], $cfg['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    return $pdo;
}

function redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}

function base_path_url(): string
{
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $base = str_replace('\\', '/', dirname($scriptName));
    if ($base === '/' || $base === '\\' || $base === '.') {
        return '';
    }

    return rtrim($base, '/');
}

function url(string $path = ''): string
{
    $base = base_path_url();
    $normalizedPath = ltrim($path, '/');

    if ($normalizedPath === '') {
        return ($base !== '' ? $base : '') . '/';
    }

    return ($base !== '' ? $base : '') . '/' . $normalizedPath;
}

function request_path(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $base = base_path_url();

    if ($base !== '' && str_starts_with($uri, $base)) {
        $uri = substr($uri, strlen($base)) ?: '/';
    }

    if ($uri === '') {
        return '/';
    }

    return '/' . ltrim($uri, '/');
}

function csrf_token(): string
{
    if (!isset($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES) . '">';
}

function verify_csrf(): void
{
    $token = $_POST['_csrf'] ?? '';
    if (!hash_equals($_SESSION['_csrf'] ?? '', $token)) {
        http_response_code(419);
        exit('Token CSRF inválido.');
    }
}

function auth_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_auth(): void
{
    if (!auth_user()) {
        redirect('/');
    }
}

function has_permission(string $slug): bool
{
    $user = auth_user();
    if (!$user) {
        return false;
    }

    return in_array($slug, $user['permissions'] ?? [], true);
}

function require_permission(string $slug): void
{
    if (!has_permission($slug)) {
        http_response_code(403);
        require BASE_PATH . '/app/views/errors/403.php';
        exit;
    }
}

function old(string $key, string $default = ''): string
{
    return htmlspecialchars($_SESSION['_old'][$key] ?? $default, ENT_QUOTES);
}

function flash(string $key, ?string $value = null): ?string
{
    if ($value !== null) {
        $_SESSION['_flash'][$key] = $value;
        return null;
    }

    $message = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $message;
}
