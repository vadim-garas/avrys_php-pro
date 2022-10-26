<?php

namespace AvrysPhp\Core\Traits;


use AvrysPhp\Core\Interfaces\ISingleton;
use LogicException;


trait SingletonTrait
{
    private static array $instances = array();

    /**
     * @return ISingleton
     */
    public static function getInstance(): self
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
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