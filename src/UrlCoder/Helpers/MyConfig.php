<?php

namespace AvrysPhp\UrlCoder\Helpers;


class MyConfig
{
    private array $config;

    use MySingleton;

    /**
     * @param string $key
     * @return string
     */
    public function getValue(string $key): string
    {
        return $this->config[$key];
    }

    /**
     * @param array $config
     * @return void
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }
}