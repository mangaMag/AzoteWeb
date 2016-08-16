<?php

return [

    'title'        => env('TITLE', 'Dofus'),

    'subtitle'     => env('SUBTITLE', 'Serveur privé'),

    'servers'      => [ 'sigma', 'epsilon' ],

    'template'     => env('TEMPLATE', 'dofus'),

    'theme'        => env('THEME', false),

    'background'   => env('BACKGROUND', 'dofus4'),

    'color'        => env('COLOR', '#000'),

    'carousel'     => env('CAROUSEL', false),

    'email'        => 'support@azote.us',

    'social'       => [

        'forum'    => 'https://forum.azote.us/',

        'facebook' => 'https://facebook.com/azote',

        'twitter'  => 'https://twitter.com/azote',

        'youtube'  => 'https://youtube.com/channel/azote',

    ],

    'vote'         => 10,

    'rpg-paradize' => [
        'id'       => env('RPG_PARADIZE', 0),
        'delay'    => 10810, // 3h + 5s
    ],

    'promos' => [],

    'payment' => [

        'used' => env('PAYMENT', 'dedipass'),

        'dedipass' => [
            'name'       => 'DediPass',
            'url'        => 'https://api.dedipass.com/v1/pay/rates?key={PUBLIC_KEY}',
            'validation' => 'http://api.dedipass.com/v1/pay/?public_key={PUBLIC_KEY}&private_key={PRIVATE_KEY}&code={CODE}',
            'public'     => env('PAYMENT_PUBLIC', 0),
            'private'    => env('PAYMENT_PRIVATE', 0),
        ],

    ],

];