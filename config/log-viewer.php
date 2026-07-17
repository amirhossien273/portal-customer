<?php

return [
    'locale' => 'fa',
    'theme' => 'bootstrap-5',
    'route' => [
        'enabled' => true,
        'attributes' => [
            'prefix' => 'system/logs',
            'middleware' => ['web', 'auth', 'system.admin'],
        ],
        'show' => 'log-viewer::logs.show',
    ],
    'per-page' => 30,
];
