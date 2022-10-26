<?php

namespace AvrysPhp\Calculator\Actions;

use AvrysPhp\Calculator\Helper\ValueValidate;

class DataCalculate
{
    protected object $calculatePossibilities;

    public function __construct(object $calculatePossibilities, float|int $var_1, float|int $var_2, string $operator)
    {
        $this->calculatePossibilities = $calculatePossibilities;
        /*
         *  я розумію, що цього тут не має бути, обїект має відповідати за свій стан,
         *  але дуже хотилося зробити каскадну ініціалізацію, тож вийшла така логіка
         */
        $this->calculatePossibilities->isOperatorExist($operator);

        new ValueValidate($var_1);
        new ValueValidate($var_2);

        $arrOperator = $this->calculatePossibilities->getCalculatePossibilities();
        $toCalc = new $arrOperator[$operator]();

        echo 'result = ' . $toCalc->mathOperation($var_1, $var_2);
    }
}
