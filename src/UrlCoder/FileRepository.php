<?php

namespace AvrysPhp\UrlCoder;

use AvrysPhp\UrlCoder\Exceptions\DataNotFoundException;
use AvrysPhp\UrlCoder\Interfaces\ICodeRepository;
use \AvrysPhp\UrlCoder\ValueObjects\UrlCodePair;

class FileRepository implements ICodeRepository
{
    protected array $arrData = [];
    protected string $fileName;

    /**
     * @param string $fileName
     * @throws DataNotFoundException
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->arrData = $this->loadDataFromFile();
    }

    public function __destruct()
    {
        $this->saveDataToFile();
    }

    public function saveEntity(UrlCodePair $urlCodePair): bool
    {
        if (!array_search($urlCodePair->getUrl(), $this->arrData))
        {
            $this->arrData += [$urlCodePair->getCode() => $urlCodePair->getUrl()];
        }

        return true;
    }

    /**
     * @return array
     * @throws DataNotFoundException
     */
    protected function loadDataFromFile(): array
    {
        try {
            $file = file_get_contents($this->fileName);
            $result = (array) json_decode($file,TRUE);
        } catch (\Exception $e) {
            throw new DataNotFoundException();
        } finally {
            unset($file);
        }

        return $result;
    }

    /**
     * @return void
     * @throws DataNotFoundException
     */
    protected function saveDataToFile(): void
    {
        try {
            file_put_contents($this->fileName, json_encode($this->arrData, JSON_FORCE_OBJECT));
        } catch (\Exception $e) {
            throw new DataNotFoundException();
        } finally {
            unset($file);
        }
    }

    public function codeIsset(string $code): bool
    {
        return isset($this->arrData[$code]);
    }

    public function getUrlByCode(string $code): string
    {
        if (!$this->codeIsset($code)) {
            throw new DataNotFoundException();
        }
        return $this->arrData[$code];
    }

    public function getCodeByUrl(string $url): string
    {
        if (!$code = array_search($url, $this->arrData)) {
            throw new DataNotFoundException();
        }
        return $code;
    }

//    public function saveData(string $strKeyUrl, string $strValStr): void
//    {
//        if (!array_key_exists($strKeyUrl, $this->arrData)) {
//            $this->arrData += [$strKeyUrl => $strValStr];
//        }
//    }
//    public function loadData(): array
//    {
//        return $this->arrData->getArrayCopy();
//    }
}