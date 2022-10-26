<?php

use AvrysPhp\Core\CLI\Commands\TestCommand;
use AvrysPhp\Core\ConfigHandler;
use AvrysPhp\Core\CLI\CommandHandler;

use AvrysPhp\UrlCoder\Helpers\SingletonLogger;
use GuzzleHttp\Client;
use UfoCms\ColoredCli\CliColor;
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};

require_once 'vendor/autoload.php';
$configs = require_once __DIR__ . '/../parameters/config.php';


$urlPath = [
    'https://www.php-fig.org/psr/',
    'https://www.liqpay.u2a/documentation/start',
    'https://refactoring.guru/ru/design-patterns/bridge/php/example',
    'https://www.youtube.com/watch?v=bZADEJQ8Z5I&list=PLuEo4W0EBxtWLw8glAHArx1JybLl81LI3&index=9',
];



try {

    print_r($configs);
    $configHandler = ConfigHandler::getInstance()->addConfigs($configs);
    $commandHandler = new CommandHandler(new TestCommand());

    $logger = new Logger($configHandler->get('monolog.channel'));
    $singletonLogger = SingletonLogger::getInstance($logger);

    // print_r(getRealPath('logFile.error', $config));

//    $configHandler = ConfigHandler::getInstance()->setParameters($configs);

//
//    MyLogger::getInstance()->setLogger(new Logger('general'));
//    MyLogger::getInstance()->pushHandler(
//        new StreamHandler( ConfigHandler::getInstance()->getValue('logError'), Level::Error)
//    );
//
//    $dbOperator = new OperatorDB(ConfigHandler::getInstance()->getValue('dbFile'));
//    $urlConnect = new UrlConnect();
//    $arrUrlTable = $dbOperator->getArrUrlTable();
//    $urlMaster = new UrlMaster($arrUrlTable);
//
//    foreach ($urlPath as $value) {
//        $urlConnect->urlFormatValidate($value);
//        $urlEncode = $urlMaster->encode($value);
//        $dbOperator->saveData($value, $urlEncode);
//    }

} catch (\Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;