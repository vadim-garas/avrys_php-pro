<?php

require_once 'autoload.php';

static $JASON_FILE_NAME = 'src/magic_func/todo.json';

$arrData = array('first', 'second', 'orange');

try {
    $myData = new \AvrysPHP\magic_fun\MyData($arrData);
    // $myData = new \AvrysPHP\magic_fun\MyData($arrData);
    $myData->getFromFile($JASON_FILE_NAME);
    $myData->addToFile($JASON_FILE_NAME, $arrData);

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;