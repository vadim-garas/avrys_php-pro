<?php

require_once 'vendor/autoload.php';

use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};
use AvrysPhp\UrlCoder\{
    Helpers\MyConfig,
    Helpers\MyLogger,
    Helpers\OperatorDB,
    Actions\UrlConnect,
    Actions\UrlMaster
};

$config = [
    'dbFile' => __DIR__.'/Helpers/url_db.json',
    'logError' => __DIR__.'/logs/error.log',
    'logInfo' => __DIR__.'/logs/info.log',
    'logAlert' => __DIR__.'/logs/alert.log'
];

$urlPath = [
    'https://www.php-fig.org/psr/',
    'https://www.liqpay.u2a/documentation/start',
    'https://refactoring.guru/ru/design-patterns/bridge/php/example',
    'https://www.youtube.com/watch?v=bZADEJQ8Z5I&list=PLuEo4W0EBxtWLw8glAHArx1JybLl81LI3&index=9',
];

/**
 * Реалізував залежність на guzzlehttp/guzzle
 * Реалізував власний логер, та обʼєкт конфігів,
 * які можна викликати в будь якому місці програми
 * Синглетон зробив trait-ом, додав його у Логер та Конфіг
 */

try {

    MyConfig::getInstance()->setConfig($config);

    MyLogger::getInstance()->setLogger(new Logger('general'));
    MyLogger::getInstance()->pushHandler(
        new StreamHandler( MyConfig::getInstance()->getValue('logError'), Level::Error)
    );

    $dbOperator = new OperatorDB(MyConfig::getInstance()->getValue('dbFile'));
    $urlConnect = new UrlConnect();
    $arrUrlTable = $dbOperator->getArrUrlTable();
    $urlMaster = new UrlMaster($arrUrlTable);

    foreach ($urlPath as $value) {
        $urlConnect->urlFormatValidate($value);
        $urlEncode = $urlMaster->encode($value);
        $dbOperator->saveData($value, $urlEncode);
    }

} catch (\Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;