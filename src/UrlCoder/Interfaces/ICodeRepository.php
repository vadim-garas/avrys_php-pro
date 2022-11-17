<?php

namespace AvrysPhp\UrlCoder\Interfaces;

use AvrysPhp\UrlCoder\Exceptions\DataNotFoundException;
use AvrysPhp\UrlCoder\ValueObjects\UrlCodePair;

interface ICodeRepository
{
    /**
     * @param UrlCodePair $urlUrlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlUrlCodePair): bool;

    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string url
     */
    public function getUrlByCode(string $code): string;

    /**
     * @param string $url
     * @throws DataNotFoundException
     * @return string code
     */
    public function getCodeByUrl(string $url): string;

//    /**
//     * @return array
//     */
//    public function loadData(): array;
//
//    /**
//     * @param string $strKeyUrl
//     * @param string $strValStr
//     */
//    public function saveData(string $strKeyUrl, string $strValStr): void;
}