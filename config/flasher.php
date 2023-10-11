<?php

return [
    'default' => 'template.kartsnms',

    'root_script' => null,

    'template_factory' => [
        'templates' => [
            'kartsnms' => [
                'view' => 'layouts.flasher-notification',
                'options' => [
                    'timeout' => 12000,
                    'style' => [
                        'top' => '55px',
                    ],
                ],
            ],
        ],
    ],
];
