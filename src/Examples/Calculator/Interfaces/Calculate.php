<?php

namespace AvrysPhp\Calculator\Interfaces;

/*
 *
 */

interface Calculate
{
    public function mathOperation (float|int $var_1, float|int $var_2): float|int;
}