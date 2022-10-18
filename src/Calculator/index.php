<?php

require_once __DIR__ . '/../autoload.php';

use AvrysPhp\Calculator\
{
    Actions\DataCalculate,
    Actions\ToDivide,
    Actions\ToExponentiation,
    Actions\ToMultiply,
    Actions\ToSubtract,
    Actions\ToSum,
    Helper\CalculatePossibilities,
    Helper\ValueValidate,
    Interfaces\Calculate
};

$number_1 = 27;
$number_2 = 3;
$operator = "-";

/*
 * виправлено згідно рекомендацій
 * додатково:
 * окремо виніс клас "оператор"
 * втілив ліниву ініціалізація потрібного екземпляру классу "оператора"
 * реалізував каскадну ініціалізацію (довелося заради цього трохи поступитися принципами ООП)
 *
 * Вміє оперувати з цілими та дробними числами наступним чином:
 *  додавати (оператор "+")
 *  віднімати (оператор "-")
 *  перемножувати (оператор "*")
 *  ділити  (оператор "/")
 *      Zero Divided Control
 * Вміє возводити у ступінь  (оператор "**"), для чого основу приводить до цілого числа
 */

try {

    $calculatePossibilities = new CalculatePossibilities();
    $calculatePossibilities
        ->setCalculatePossibilities('+', toSum::class)
        ->setCalculatePossibilities('-', ToSubtract::class)
        ->setCalculatePossibilities('*', ToMultiply::class)
        ->setCalculatePossibilities('**', toExponentiation::class)
        ->setCalculatePossibilities('/', toDivide::class);

    new DataCalculate ($calculatePossibilities, $number_1,  $number_2, $operator);

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;