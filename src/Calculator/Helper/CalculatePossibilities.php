<?php

namespace AvrysPhp\Calculator\Helper;

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