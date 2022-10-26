<?php

namespace AvrysPhp\Core;

use AvrysPhp\Core\Exceptions\ParameterNotFoundException;
use AvrysPhp\Core\Interfaces\IConfigHandler;
use AvrysPhp\Core\Interfaces\ISingleton;
use AvrysPhp\Core\Traits\SingletonTrait;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ConfigHandler implements IConfigHandler, ISingleton
{
    protected array $parameters = [];

    use SingletonTrait;

    /**
     * @param string $key
     * @return string
     */
    public function getValue(string $key): string
    {
        $tokens = explode('.', $key);
        $context = $this->parameters;

        while (null !== ($token = array_shift($tokens))) {
            if (!isset($context[$token])) {
                 throw new ParameterNotFoundException('Parameter not found: ' . $key);
            }

            $context = $context[$token];
        }
        return $context;
    }

    /**
     * @param array $configs
     * @return self
     */
    public function addConfigs(array $configs): self
    {
        $this->parameters = array_merge($this->parameters, $configs);
        return $this;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get(string $id): mixed
    {
        try {
            $result = true;
            $this->getValue($id);
        } catch (ParameterNotFoundException $e) {
            $result = false;
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        // TODO: Implement has() method.
        return true;
    }
}