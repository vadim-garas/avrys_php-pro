<?php

namespace AvrysPhp\UrlCoder\Helpers;

use AvrysPhp\Core\Traits\SingletonTrait;
use Psr\Log\LoggerInterface;
use Monolog\Handler\AbstractProcessingHandler;

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

    public function setLogger($logger): void
    {
        $this->logger = $logger;
    }
}