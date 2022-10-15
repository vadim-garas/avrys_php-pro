<?php

use PhpPro\calculator\ValueValidate;

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



interface Calculate
{
    public function mathOperation (int|float $var_1, int|float $var_2): float|int;
}

final class ToSum implements Calculate
{
    public function mathOperation (int|float $var_1, int|float $var_2): float|int
    {
        return $var_1 + $var_2;
    }
}

final class ToSubtract implements Calculate
{
    public function mathOperation (int|float $var_1, int|float $var_2): float|int
    {
        return $var_1 - $var_2;
    }
}

class toMultiply implements Calculate
{
    public function mathOperation (int|float $var_1, int|float $var_2): float|int
    {
        return $var_1 * $var_2;
    }
}

class toExponentiation  extends toMultiply
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


class toDivide implements Calculate
{
    public function mathOperation (float|int $var_1, float|int $var_2): float|int
    {
        if ($var_2 == 0) {
            throw new InvalidArgumentException('!!! Zero Divided' );
        }
        return $var_1 / $var_2;
    }
}

class CalculatePossibilities
{

    protected array $arrOperator;

    public function __construct()
    {
        $this->arrOperator = array();
    }

    public function setCalculatePossibilities(string $key, string $value): static
    {
        $this->arrOperator[$key] = $value;
        return $this;
    }

    public function isOperatorExist($operator): void
    {
        if (!isset($this->arrOperator[$operator])) {
            throw new \http\Exception\InvalidArgumentException('operator not exist');
        }
        echo 'operator "' . $operator . '" is registered' . PHP_EOL;
    }

    public function getCalculatePossibilities(): array
    {
        return $this->arrOperator;
    }
}


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

try {

    $calculatePossibilities = new CalculatePossibilities();
    $calculatePossibilities
        ->setCalculatePossibilities('+', toSum::class)
        ->setCalculatePossibilities('-', ToSubtract::class)
        ->setCalculatePossibilities('*', toMultiply::class)
        ->setCalculatePossibilities('**', toExponentiation::class)
        ->setCalculatePossibilities('/', toDivide::class);

    new DataCalculate ($calculatePossibilities, $number_1,  $number_2, $operator);

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;