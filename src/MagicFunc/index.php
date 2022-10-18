<?php

use AvrysPhp\MagicFunc\MyData;

require_once __DIR__ . '/../autoload.php';

static $JASON_FILE_NAME = 'src/MagicFunc/todo.json';

$arrData = array('first', 'second');

try {
    $myData = new MyData($arrData);
    $myData->getFromFile($JASON_FILE_NAME);
    $myData->addToFile($JASON_FILE_NAME, $arrData);

    $myData_1 = clone $myData;
    $myData_1->getFromFile($JASON_FILE_NAME);
    $myData_1->addToFile($JASON_FILE_NAME, $arrData);

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;