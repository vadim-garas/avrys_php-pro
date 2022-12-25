<?php

use AvrysPhp\Core\WEB\Controllers\CalcController;
use Doctor\PhpPro\Calculator\SmartCalculator;

// use Doctor\PhpPro\Core\DI\Container;

require_once '../vendor/autoload.php';

/**
 * @var Container $container
 */

// $container = require_once __DIR__ . '/../src/bootstrap.php';

//$arrPathParts = explode('/', $_SERVER['REQUEST_URI']);
//$lastPart = array_pop($arrPathParts);
//$pathParts = array_values(array_filter(explode('?', $lastPart )));
//$controller = array_shift($pathParts);

$pathParts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$controller = array_pop($pathParts);

echo 'CONTROLLER: ' . $controller . '<br>';

//echo 'PARSE URL:' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '<br>';

    // array_shift(explode('?', $lastPart ));


// print_r ($pathParts) . PHP_EOL;
// $controller = array_shift($pathParts);


$controllerClass = 'AvrysPhp\Core\WEB\Controllers\\'.ucfirst($controller).'Controller';
// $controllerClass = ucfirst($controller).'Controller';

echo 'controller class name: ' . $controllerClass . '<br>';
echo 'routing: ' . CalcController::class . '<br>';

$routingMap = [
    CalcController::class => 'getSum'
];

try {
    $method = $routingMap[$controllerClass];

    $controllerObject = new $controllerClass();

    // Avrys\PhpPro\Core\WEB\Controllers\CalcController
    // $controllerObject = $container->get('c.user');

    // echo call_user_func_array([$controllerObject, $method], $pathParts);

    echo $_GET['var_1'] . '<br>';
    $val_1 = filter_input(INPUT_GET, 'var_2', FILTER_VALIDATE_FLOAT);
    $val_2 = filter_input(INPUT_GET, 'var_2', FILTER_VALIDATE_FLOAT);

    echo call_user_func_array([$controllerObject, $method], [$val_1, $val_2]);
} catch (TypeError $e) {
    echo 'Invalid parameter '.$e->getMessage();
    die();
} catch (Exception) {
    echo 'Routing not found';
    die();
}


echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '<br>';
echo $_GET['var_1'] . '<br>';
echo filter_input(INPUT_GET, 'var_2', FILTER_VALIDATE_INT) . '<br>';

echo 'TEST!!!!!!11111';

$calculator = new SmartCalculator();

exit;