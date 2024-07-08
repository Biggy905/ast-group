<?php

$common = [
    [
        'verb' => ['get'],
        'pattern' => '/',
        'route' => 'index/index',
    ],
    [
        'verb' => ['post'],
        'pattern' => 'login',
        'route' => 'user/login',
    ],
];

$event = [
    [
        'verb' => ['get'],
        'pattern' => 'event/<id>/item',
        'route' => 'event/item',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'events/<page:\d+>',
        'route' => 'event/list',
        'defaults' => [
            'page' => '1',
        ],
    ],
    [
        'verb' => ['post'],
        'pattern' => 'event/create',
        'route' => 'event/create',
    ],
    [
        'verb' => ['patch'],
        'pattern' => 'event/<id>/update',
        'route' => 'event/update'
    ],
    [
        'verb' => ['delete'],
        'pattern' => 'event/<id>/delete',
        'route' => 'event/delete',
    ]
];

$manager = [
    [
        'verb' => ['get'],
        'pattern' => 'manager/<id>/item',
        'route' => 'manager/item',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'managers/<page:\d+>',
        'route' => 'manager/list',
        'defaults' => [
            'page' => '1',
        ],
    ],
    [
        'verb' => ['post'],
        'pattern' => 'manager/create',
        'route' => 'manager/create',
    ],
    [
        'verb' => ['patch'],
        'pattern' => 'manager/<id>/update',
        'route' => 'manager/update'
    ],
    [
        'verb' => ['delete'],
        'pattern' => 'manager/<id>/delete',
        'route' => 'manager/delete',
    ]
];

return array_merge(
    $common,
    $event,
    $manager,
);
