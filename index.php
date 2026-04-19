<?php

declare(strict_types=1);

session_start([
    'cookie_httponly' => true,
    'cookie_secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    'cookie_samesite' => 'Lax',
]);

define('BASE_PATH', __DIR__);

spl_autoload_register(function ($class): void {
    $prefix = 'App\\';
    $baseDir = BASE_PATH . '/app/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

require BASE_PATH . '/app/helpers/functions.php';

$router = new App\Core\Router();
require BASE_PATH . '/routes/web.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], request_path());
