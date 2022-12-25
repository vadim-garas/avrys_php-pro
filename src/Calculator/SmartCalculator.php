<?php
namespace Doctor\PhpPro\Calculator;



class SmartCalculator extends Calculator
{
    public function calculateExpression(string $exp)
    {
        $data = explode(' ', $exp);
        new NumberValidator($data[0]);
        new NumberValidator($data[2]);

        $result = $this->calculate($data[0], $data[2], $data[1]);
        return $this->calculate($data[0], $data[2], $data[1]);
    }
}
