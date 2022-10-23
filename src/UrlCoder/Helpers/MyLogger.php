<?php

namespace AvrysPhp\UrlCoder\Helpers;

use Psr\Log\LoggerInterface;
use Monolog\Handler\AbstractProcessingHandler;

class MyLogger
{
    protected  LoggerInterface $logger;

    use MySingleton;

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