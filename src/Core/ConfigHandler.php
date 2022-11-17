<?php

namespace AvrysPhp\Core;

use AvrysPhp\Core\Exceptions\ParameterNotFoundException;
use AvrysPhp\Core\Interfaces\IConfigHandler;
use AvrysPhp\Core\Interfaces\ISingleton;
use AvrysPhp\Core\Traits\SingletonTrait;


class ConfigHandler implements IConfigHandler, ISingleton
{
    use SingletonTrait;

    /**
     * @var array Parameters from file
     */
    protected array $parameters = [];

    /**
     * @description Parameter array loading method
     * @param array $configs
     * @return $this
     */
    public function addConfigs(array $configs): self
    {
        $this->parameters = array_merge($this->parameters, $configs);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        try {
            $result = true;
            $this->getRealPath($id);
        } catch (ParameterNotFoundException $e) {
            $result = false;
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
    {
        return $this->getRealPath($id);
    }

    public function __get($name)
    {
        return $this->get(str_replace('_', '.', $name));
    }

    protected function getRealPath(string $id): mixed
    {
        $tokens = explode('.', $id);
        $context = $this->parameters;

        while (null !== ($token = array_shift($tokens))) {
            if (!isset($context[$token])) {
                throw new ParameterNotFoundException('Parameter not found: ' . $id);
            }

            $context = $context[$token];
        }
        return $context;
    }
}