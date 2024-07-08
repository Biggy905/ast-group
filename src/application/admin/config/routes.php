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

return array_merge(
    $common,
);
