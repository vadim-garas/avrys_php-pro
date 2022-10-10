<?php

$number_1 = 27;
$number_2 = 3;
$operator = "/";

/*
 * Вміє оперувати з цілими та дробними числами наступним чином:
 *  додавати (оператор "+")
 *  віднімати (оператор "-")
 *  перемножувати (оператор "*")
 *  ділити  (оператор "/")
 *      Zero Divided Control
 * Вміє возводити у ступінь  (оператор "**"), для чого основу приводить до цілого числа
 */

class ValueValidate
{
    private $element;

    public function __construct($element)
    {
        $this->element = $element;
        $this->isSetValue();
        $this->isNumber();
    }

    private function isSetValue ()
    {
        if (!isset($this->element))
        {
            throw new InvalidArgumentException('value is not set' );
        }
    }

    public function isNumber ()
    {
        if (!is_numeric($this->element))
        {
            throw new InvalidArgumentException('is not a number' );
        }
    }
}

interface Calculate
{
    public function mathOperation ($var_1, $var_2);
}

final class ToSum implements Calculate
{
    public function mathOperation ($var_1, $var_2)
    {
        return $var_1 + $var_2;
    }
}

final class ToSubtract implements Calculate
{
    public function mathOperation ($var_1, $var_2)
    {
        return $var_1 - $var_2;
    }
}

class toMultiply implements Calculate
{
    public function mathOperation ($var_1, $var_2)
    {
        return $var_1 * $var_2;
    }
}

class toExponentiation  extends toMultiply
{
    public function mathOperation ($var_1, $var_2)
    {
        $var_2 = $this->toInteger ($var_2);

        return pow($var_1, $var_2);
    }

    protected function toInteger ($var_2)
    {
        return is_int($var_2) ? $var_2 : round($var_2);
    }
}


class toDivide implements Calculate
{
    public function mathOperation ($var_1, $var_2)
    {
        if ($var_2 == 0) {
            throw new InvalidArgumentException('!!! Zero Divided' );
        }
        return $var_1 / $var_2;
    }
}

//class toExtraction  extends toDivide
//{
//    public function mathOperation($var_1, $var_2)
//    {
//        $var_2 = $this->toInteger ($var_2);
//
//        return gmp_root($var_1, $var_2);
//    }
//
//    protected function toInteger ($var_2)
//    {
//        return is_int($var_2) ? $var_2 : round($var_2);
//    }
//}


class DataCalculate
{
    protected $calculatePossibilities = [
        '+'     => toSum::class,
        '-'     => ToSubtract::class,
        '*'     => toMultiply::class,
        '**'    => toExponentiation::class,
        '/'     => toDivide::class,
        '//'    => toExtraction::class
    ];

    public function __construct($var_1, $var_2, $operator)
    {
        new ValueValidate($var_1);
        new ValueValidate($var_2);

        if (!isset($this->calculatePossibilities[$operator])) {
            throw new \http\Exception\InvalidArgumentException('operator not exist');
        }

        $toCalc = new $this->calculatePossibilities[$operator]();
        echo $toCalc->mathOperation($var_1, $var_2);
    }
}


try {

    new DataCalculate ($number_1,  $number_2, $operator);

} catch (Exception $e) {

    echo $e->getMessage();
}

echo PHP_EOL;