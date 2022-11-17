<?php

use AvrysPhp\Core\CLI\CLIWriter;
use AvrysPhp\Core\CLI\Commands\TestCommand;
use AvrysPhp\Core\CLI\Commands\UrlDecodeCommand;
use AvrysPhp\Core\CLI\Commands\UrlEncodeCommand;
use AvrysPhp\Core\ConfigHandler;
use AvrysPhp\Core\CLI\CommandHandler;

use AvrysPhp\UrlCoder\Actions\UrlConvertor;
use AvrysPhp\UrlCoder\Actions\UrlValidator;
use AvrysPhp\UrlCoder\FileRepository;
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

    $command = new TestCommand();
    $command->run();



    $configHandler = ConfigHandler::getInstance()->addConfigs($configs);
    $commandHandler = new CommandHandler(new TestCommand());
    echo 'TEST 1: ' . $configHandler->get('monolog.channel') . PHP_EOL;
    $logger = new Logger($configHandler->get('monolog.channel'));

    $singletonLogger = SingletonLogger::getInstance($logger);
    $singletonLogger->pushHandler(new StreamHandler($configHandler->get('monolog.level.error'), Level::Error))
        ->pushHandler(new StreamHandler($configHandler->get('monolog.level.info'), Level::Info));

    $fileRepository = new FileRepository($configHandler->get('dbFile'));
    $urlValidator = new UrlValidator(new Client());
    $converter = new UrlConvertor(
        $fileRepository,
        $urlValidator,
        $configHandler->get('urlConverter.codeLength')
    );

    $commandHandler->addCommand(new UrlEncodeCommand($converter));
    $commandHandler->addCommand(new UrlDecodeCommand($converter));

    echo 'ENCODE URL: ' . $converter->encode('https://www.php-fig.org/psr/') . PHP_EOL;

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