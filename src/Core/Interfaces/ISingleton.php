<?php

namespace  AvrysPhp\Core\Interfaces;

interface ISingleton
{
    public static function getInstance(): self;
}