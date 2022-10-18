<?php

namespace AvrysPhp\Calculator\Actions;

use AvrysPhp\Interfaces\Calculate;

final class ToSum implements Calculate
{
    public function mathOperation (int|float $var_1, int|float $var_2): float|int
    {
        return $var_1 + $var_2;
    }
}