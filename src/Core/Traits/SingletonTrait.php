<?php

namespace AvrysPhp\Core\Traits;


use AvrysPhp\Core\Interfaces\ISingleton;
use LogicException;


trait SingletonTrait
{
    protected static ?self $instance = null;

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    protected function __construct() { }
    protected function __clone() { }

    /**
     * @throws LogicException
     */
    public function __wakeup() {
        throw new LogicException('Cannot call method: ' . __METHOD__ . ' a singleton.');
    }

    /**
     * @throws LogicException
     */
    public function __unserialize(array $data): void
    {
        throw new LogicException('Cannot call method: ' . __METHOD__ . ' a singleton.');
    }
}