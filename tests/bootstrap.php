<?php

$loader = require __DIR__.'/../vendor/autoload.php';

// Keep tests isolated to this application even when a shared vendor runtime
// is used by the local workspace.
$loader->setPsr4('App\\', [__DIR__.'/../app']);
$loader->setPsr4('Tests\\', [__DIR__]);

spl_autoload_register(static function (string $class): void {
    foreach (['App\\' => __DIR__.'/../app/', 'Tests\\' => __DIR__.'/'] as $prefix => $directory) {
        if (! str_starts_with($class, $prefix)) {
            continue;
        }

        $path = $directory.str_replace('\\', '/', substr($class, strlen($prefix))).'.php';
        if (is_file($path)) {
            require $path;
        }
    }
}, true, true);
