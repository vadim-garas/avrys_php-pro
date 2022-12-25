<?php

use AvrysPhp\Core\WEB\Controllers\CalcController;

require_once '../vendor/autoload.php';

$pathParts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$controller = array_pop($pathParts);
$controllerClass = 'AvrysPhp\Core\WEB\Controllers\\'.ucfirst($controller).'Controller';

$routingMap = [
    CalcController::class => 'getResult'
];

try {
    $method = $routingMap[$controllerClass];

    /**
     * @var $controllerObject CalcController
     */
    $controllerObject = new $controllerClass();

    /**
     * http://localhost/calc?exp=3%20%2b%205 ("\\+", "%2b") // '3 + 5'
     * http://localhost/calc?exp=3%20%2a%205 ("\\*", "%2a") // '3 * 5'
     * http://localhost/calc?exp=3%20%2d%205 ("-", "%2d")   // '3 - 5'
     * http://localhost/calc?exp=3%20%2f%205 ("/", "%2f")   // '3 / 5'
     *
     * (" ", "%20")   // пробіл
     */

    $expression = ''.$_GET['exp'];
    echo 'EXP: '.$expression.'<br>';

    echo 'CALCULATION RESULT = '.(call_user_func_array([$controllerObject, $method], [$expression]));

} catch (TypeError $e) {
    echo 'Invalid parameter '.$e->getMessage();
    die();
} catch (Exception) {
    echo 'Routing not found';
    die();
}

exit;