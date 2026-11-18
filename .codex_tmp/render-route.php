<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/solutions/truck-movement-planning', 'GET');
$response = $kernel->handle($request);
fwrite(STDOUT, (string) $response->getStatusCode().PHP_EOL);
fwrite(STDOUT, $response->getContent());
$kernel->terminate($request, $response);
