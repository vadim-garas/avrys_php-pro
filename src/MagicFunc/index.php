<?php

require_once __DIR__.'/autoload.php';

static $JASON_FILE_NAME = 'src/MagicFunc/todo.json';

$arrData = array('first', 'second', 'orange');

try {
    $myData = new \AvrysPhp\MyData($arrData);
    $myData->getFromFile($JASON_FILE_NAME);
    $myData->addToFile($JASON_FILE_NAME, $arrData);

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;