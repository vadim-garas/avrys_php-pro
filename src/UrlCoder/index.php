<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use http\Exception;
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};
use AvrysPhp\UrlCoder\ {
    Helpers\OperatorDB,
    Actions\UrlConnect,
    Actions\UrlMaster,
    Interfaces\IOperatorDB
};

$config = [
    'dbFile' => __DIR__.'/Helpers/url_db.json',
    'logFile' => [
        'error' => __DIR__ . '/logs/error.log',
        'info' => __DIR__ . '/logs/info.log',
        'alert' => __DIR__ . '/logs/alert.log'
    ]
];

$urlPath = [
    'https://www.php-fig.org/psr/',
    'https://www.liqpay.ua/documentation/start',
    'https://refactoring.guru/ru/design-patterns/bridge/php/example',
    'https://www.youtube.com/watch?v=bZADEJQ8Z5I&list=PLuEo4W0EBxtWLw8glAHArx1JybLl81LI3&index=9',
];

$logger = new Logger('general');
$logger->pushHandler(new StreamHandler($config['logFile']['error'], Level::Error));
$logger->pushHandler(new StreamHandler($config['logFile']['info'], Level::Info));
$logger->pushHandler(new StreamHandler($config['logFile']['alert'], Level::Alert));


try {
    // echo 'DATA BASE FILE PATH = ' . $config['dbFile'] . PHP_EOL;
    $dbOperator = new OperatorDB($config['dbFile']);
    $urlConnect = new UrlConnect($logger);
    $arrUrlTable = $dbOperator->getArrUrlTable();
    $urlMaster = new UrlMaster($arrUrlTable, $logger);

    foreach ($urlPath as $value) {
        $urlConnect->urlFormatValidate($value);
        $urlEncode = $urlMaster->encode($value);
        $dbOperator->saveData($value, $urlEncode);

        // Test decode with any key from url_db.json
        // echo 'URL PATH DECODE: ' . $urlMaster->decode('refactoring.guru/nhd') . PHP_EOL;
    }

} catch (\Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;