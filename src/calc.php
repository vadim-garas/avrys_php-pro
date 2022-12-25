<?php

use AvrysPhp\Core\CLI\CLIWriter;
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


try {

    $command = new TestCommand();
    $command->run();

    $configHandler = ConfigHandler::getInstance()->addConfigs($configs);
    $commandHandler = new CommandHandler(new TestCommand());
    echo 'TEST 1: ' . $configHandler->get('monolog.channel') . PHP_EOL;
    $logger = new Logger($configHandler->get('monolog.channel'));

    $singletonLogger = SingletonLogger::getInstance($logger);
    $singletonLogger->pushHandler(new StreamHandler($configHandler->get('monolog.level.error'), Level::Error))
        ->pushHandler(new StreamHandler($configHandler->get('monolog.level.info'), Level::Info));





    $commandHandler->handle($argv, function ($params, \Throwable $e) {
        SingletonLogger::error($e->getMessage());
        CLIWriter::getInstance()->setColor(CliColor::RED)
            ->writeLn($e->getMessage());

        CLIWriter::getInstance()->write($e->getFile() . ': ')
            ->writeLn($e->getLine());
    });
} catch (\Exception $e) {

    echo $e->getMessage();
} finally {
    exit;
}