<?php

namespace AvrysPhp\UrlCoder\Helpers;


trait MySingleton
{
    private static array $instances = array();

    /**
     * @return null|static
     */
    public static function getInstance(): null|static
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    protected function __construct() { }
    protected function __clone() { }
    public function __wakeup() { }
}