<?php

return [
    'dbFile' => __DIR__.'/Helpers/url_db.json',
    'monolog' => [
        'channel' => 'general',
        'level' => [
            'error' => __DIR__ . '/../logs/error.log',
            'info' => __DIR__ . '/../logs/info.log',
            'alert' => __DIR__ . '/../logs/alert.log'
        ],
    ],
];

//return [
//    'dbFile' => __DIR__.'/Helpers/url_db.json',
//    'logFile' => [
//        'error' => __DIR__ . '/logs/error.log',
//        'info' => __DIR__ . '/logs/info.log',
//        'alert' => __DIR__ . '/logs/alert.log'
//    ]
//];
