<?php

$publicPath = realpath(__DIR__.'/../public');
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$assetPath = $publicPath.DIRECTORY_SEPARATOR.ltrim(str_replace('/', DIRECTORY_SEPARATOR, $requestPath), DIRECTORY_SEPARATOR);

if ($requestPath !== '/' && is_file($assetPath)) {
    return false;
}

$loader = require __DIR__.'/../../sepand-crm/vendor/autoload.php';
$appPath = realpath(__DIR__.'/../app');
$loader->setPsr4('App\\', [$appPath]);

spl_autoload_register(static function (string $class) use ($appPath): void {
    if (! str_starts_with($class, 'App\\')) {
        return;
    }

    $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, 4)).'.php';
    $path = $appPath.DIRECTORY_SEPARATOR.$relative;

    if (is_file($path)) {
        require_once $path;
    }
}, true, true);

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
