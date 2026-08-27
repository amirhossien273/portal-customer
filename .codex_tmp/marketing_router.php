<?php

$publicPath = realpath(__DIR__.'/../public');
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$assetPath = $publicPath.str_replace('/', DIRECTORY_SEPARATOR, $requestPath);

if ($requestPath !== '/' && is_file($assetPath)) {
    return false;
}

$loader = require __DIR__.'/../../sepand-crm/vendor/autoload.php';
$loader->setPsr4('App\\', [__DIR__.'/../app']);

spl_autoload_register(static function (string $class): void {
    if (! str_starts_with($class, 'App\\')) {
        return;
    }

    $path = __DIR__.'/../app/'.str_replace('\\', '/', substr($class, 4)).'.php';

    if (is_file($path)) {
        require $path;
    }
}, true, true);

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
