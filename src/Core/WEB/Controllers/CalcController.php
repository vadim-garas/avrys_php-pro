<?php

namespace AvrysPhp\Core\WEB\Controllers;

use Doctor\PhpPro\Calculator\Actions\Div;
use Doctor\PhpPro\Calculator\Actions\Expo;
use Doctor\PhpPro\Calculator\Actions\Multi;
use Doctor\PhpPro\Calculator\Actions\Sub;
use Doctor\PhpPro\Calculator\Actions\Sum;
use Doctor\PhpPro\Calculator\SmartCalculator;


class CalcController
{
    private SmartCalculator $calculator;


    public function __construct()
    {
        echo 'Smart calculator constructor is called.';
        $this->calculator = new SmartCalculator();
    }

    public function getResult($exp): string
    {
        $this->calculator->actionsRegistration([new Sum(), new Div(), new Multi(), new Expo(), new Sub()]);
        return $this->calculator->calculateExpression($exp);
    }
}