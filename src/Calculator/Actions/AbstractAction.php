<?php
namespace Doctor\PhpPro\Calculator\Actions;


use Doctor\PhpPro\Calculator\Interfaces\ICanCalculate;

abstract class AbstractAction implements ICanCalculate
{
    const SIGNATURE = '';

    public static function getSignature(): string
    {
        return static::SIGNATURE;
    }
}
