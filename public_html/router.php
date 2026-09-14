<?php
// Router for PHP's built-in dev server: php -S localhost:8080 -t public_html public_html/router.php
// Mirrors .htaccess: serve real files, send everything else to index.php.
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false;
}
$_SERVER['SCRIPT_NAME'] = '/index.php';
chdir(__DIR__);
require __DIR__ . '/index.php';
