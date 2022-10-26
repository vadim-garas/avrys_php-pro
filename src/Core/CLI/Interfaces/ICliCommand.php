<?php

namespace AvrysPhp\Core\CLI\Interfaces;


use AvrysPhp\Core\CLI\Exceptions\CliCommandException;

interface ICliCommand
{
    /**
     * @return string
     */
    public static function getCommandName(): string;

    /**
     * @return string
     */
    public static function getCommandDesc(): string;

    /**
     * @param array $params
     * @return void
     * @throws CliCommandException
     */
    public function run(array $params = []): void;
}
