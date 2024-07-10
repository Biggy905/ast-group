<?php

return [
    [
        'verb' => ['get'],
        'pattern' => '/',
        'route' => 'site/index',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'events/<page:\d+>',
        'route' => 'site/list',
        'defaults' => [
            'page' => '1',
        ],
    ],
];
