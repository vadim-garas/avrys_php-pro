<?php

namespace AvrysPhp\Calculator\Actions;

use AvrysPhp\Interfaces\Calculate;

class ToDivide implements Calculate
{
    public function mathOperation (float|int $var_1, float|int $var_2): float|int
    {
        if ($var_2 == 0) {
            throw new InvalidArgumentException('!!! Zero Divided' );
        }
        return $var_1 / $var_2;
    }
}