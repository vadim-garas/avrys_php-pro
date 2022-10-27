<?php

return [
    'dbFile' => __DIR__.'/../storage/url_db.json',
    'monolog' => [
        'channel' => 'general',
        'level' => [
            'error' => __DIR__ . '/../logs/error.log',
            'info' => __DIR__ . '/../logs/info.log',
            'alert' => __DIR__ . '/../logs/alert.log'
        ],
    ],
    'urlConverter' => [
        'codeLength' => 20,
    ],
];

