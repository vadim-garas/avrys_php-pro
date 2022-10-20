<?php

namespace AvrysPhp\UrlCoder\Interfaces;

interface IOperatorDB
{

    /**
     * @return array
     */
    public function loadData(): array;

    /**
     * @param string $strKeyUrl
     * @param string $strValStr
     */
    public function saveData(string $strKeyUrl, string $strValStr): void;
}