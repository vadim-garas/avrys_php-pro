<?php

namespace AvrysPhp\Calculator\Actions;

use AvrysPhp\Interfaces\Calculate;

class ToExponentiation  extends ToMultiply
{
    public function mathOperation (int|float $var_1, int|float $var_2): float|int
    {
        $var_2 = $this->toInteger ($var_2);

        return pow($var_1, $var_2);
    }

    protected function toInteger ($var_2): int
    {
        return is_int($var_2) ? $var_2 : round($var_2);
    }
}