<?php

namespace AvrysPhp\UrlCoder\Helpers;

use AvrysPhp\Core\Traits\SingletonTrait;
use Psr\Log\LoggerInterface;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * @method static emergency(string $message, array $context = [])
 * @method static alert(string $message, array $context = [])
 * @method static critical(string $message, array $context = [])
 * @method static error(string $message, array $context = [])
 * @method static warning(string $message, array $context = [])
 * @method static notice(string $message, array $context = [])
 * @method static info(string $message, array $context = [])
 * @method static debug(string $message, array $context = [])
 * @method static log($level, string $message, array $context = [])
 */

class SingletonLogger
{
    protected  LoggerInterface $logger;

    use SingletonTrait;

    /**
     * @param string $message
     * @return void
     */
    public function msgToLogger(string $message): void
    {
        echo 'LOGGER MESSAGE IS CALL' . PHP_EOL;
        $this->logger->error($message);
    }

    public function pushHandler(AbstractProcessingHandler $handler): self
    {
        $this->logger->pushHandler($handler);
        return $this;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}