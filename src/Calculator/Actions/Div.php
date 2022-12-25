<?php

namespace Doctor\PhpPro\Calculator\Actions;

class Div extends AbstractAction
{
    const SIGNATURE = '/';

    public function calculate(float|int $val1, float|int $val2): int|float
    {
        if ($val2 == 0) {
            throw new \InvalidArgumentException('Division by zero');
        }
        return $val1 / $val2;
    }
}
