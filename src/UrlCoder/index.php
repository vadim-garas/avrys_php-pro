<?php

require_once __DIR__ . '/autoload.php';

use http\Exception;

$urlPath = [
    'https://www.php-fig.org/psr/',
    'https://www.liqpay.ua/documentation/start',
    'https://refactoring.guru/ru/design-patterns/bridge/php/example',
    'https://www.youtube.com/watch?v=bZADEJQ8Z5I&list=PLuEo4W0EBxtWLw8glAHArx1JybLl81LI3&index=9',
];


try {

    $dbOperator = new \AvrysPhp\Helper\OperatorDB();
    $urlConnect = new \AvrysPhp\Actions\UrlConnect();
    $arrUrlTable = $dbOperator->getArrUrlTable();
    $urlMaster = new \AvrysPhp\Actions\UrlMaster($arrUrlTable);

    foreach ($urlPath as $value) {
        $urlConnect->urlFormatValidate($value);
        $urlEncode = $urlMaster->encode($value);
        $dbOperator->saveData($value, $urlEncode);

        // Test decode with any key from url_db.json
        echo 'URL PATH DECODE: ' . $urlMaster->decode('refactoring.guru/nhd') . PHP_EOL;
    }

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;