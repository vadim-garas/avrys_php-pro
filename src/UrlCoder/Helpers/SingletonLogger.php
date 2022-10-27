<?php

namespace AvrysPhp\UrlCoder\Helpers;

use AvrysPhp\Core\Interfaces\ISingleton;
use AvrysPhp\Core\Traits\SingletonTrait;
use Psr\Log\LoggerInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Stringable;


class SingletonLogger implements ISingleton
{
    use SingletonTrait;

    protected LoggerInterface $logger;

    public static function getInstance(LoggerInterface $logger = null): self
    {
        if (null === self::$instance) {
            if (is_null($logger)) {
                throw new \InvalidArgumentException('Logger is undefined');
            }
            self::$instance = new static($logger);
        }
        return self::$instance;
    }

    /**
     * @param LoggerInterface $logger
     */
    protected function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
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

    /**
     * @param Stringable|string $message
     * @param array $context
     * @return void
     */

    /**
     * @param Stringable|string $message
     * @param array $context
     * @return void
     */
    public static function emergency(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->emergency($message, $context);
    }

    public static function alert(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->alert($message, $context);
    }

    public static function critical(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->critical($message, $context);
    }

    public static function error(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->error($message, $context);
    }

    public static function warning(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->warning($message, $context);
    }

    public static function notice(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->notice($message, $context);
    }

    public static function info(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->info($message, $context);
    }

    public static function debug(Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->debug($message, $context);
    }

    public static function log($level, Stringable|string $message, array $context = []): void
    {
        self::getInstance()->getLogger()->log($level, $message, $context);
    }
}