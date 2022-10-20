<?php

namespace AvrysPhp\UrlCoder\Helpers;

use AvrysPhp\UrlCoder\Interfaces\IOperatorDB;

class OperatorDB implements IOperatorDB
{
    protected array $arrData;
    protected string $fileName;

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->arrData = $this->loadData();
    }

    /**
     * @return array
     */
    public function getArrUrlTable(): array
    {
        return $this->loadData();
    }

    /**
     * @return array
     */
    public function loadData(): array
    {
        $file = file_get_contents($this->fileName);
        $result = (array) json_decode($file,TRUE);
        unset($file);

        return $result;
    }

    /**
     * @param string $strKeyUrl
     * @param string $strValStr
     */
    public function saveData(string $strKeyUrl, string $strValStr): void
    {
        if (!array_key_exists($strKeyUrl, $this->arrData)) {
            $this->arrData += [$strKeyUrl => $strValStr];
            file_put_contents($this->fileName, json_encode($this->arrData, JSON_FORCE_OBJECT));
            unset($file);
        }
        print_r($this->arrData);
    }
}