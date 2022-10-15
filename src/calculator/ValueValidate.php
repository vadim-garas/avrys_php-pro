<?php

namespace PhpPro\calculator;
class ValueValidate
{
    private int|float $element;

    public function __construct($element)
    {
        $this->element = $element;
        $this->isSetValue();
        $this->isNumber();
    }

    private function isSetValue(): void
    {
        if (!isset($this->element)) {
            throw new InvalidArgumentException('value is not set');
        }
    }

    public function isNumber(): void
    {
        if (!is_numeric($this->element)) {
            throw new InvalidArgumentException('is not a number');
        }
    }
}