<?php

namespace AvrysPhp\UrlCoder\Actions;

use AvrysPhp\UrlCoder\Helpers\SingletonLogger;
use AvrysPhp\UrlCoder\Interfaces\ICodeRepository;
use AvrysPhp\UrlCoder\Interfaces\IUrlDecoder;
use AvrysPhp\UrlCoder\Interfaces\IUrlEncoder;
use AvrysPhp\UrlCoder\Interfaces\IUrlValidator;


class UrlConvertor implements IUrlDecoder, IUrlEncoder
{
    protected IUrlValidator $validator;
    protected ICodeRepository $repository;
    const CHAR_SET = '0123456789abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ';
    protected array $arrCutParts;
    protected int $urlLen;
    protected array $arrData;

    /**
     * @param array $arrData
     * @param ICodeRepository $repository
     * @param IUrlValidator $validator
     */
    public function __construct(ICodeRepository $repository, IUrlValidator $validator, array $arrData, )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->arrData = $arrData;
        $this->arrCutParts = array('https://', 'www.');
        $this->urlLen = 20;
    }

    /**
     * @param string $code
     * @throws \InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string
    {
        if (!in_array($code, $this->arrData)) {
            SingletonLogger::getInstance()->msgToLogger('ERROR: failed data, url ' . $code . ' is not exist in db');
            throw new \http\Exception\InvalidArgumentException('failed data, url ' . $code . ' is not exist in db');
        }

        return array_search($code, $this->arrData);
    }

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string
    {
        $temp = str_replace($this->arrCutParts, '', $url);
        $trim = preg_replace('/\/(.*)/', '', $temp);

        if (strlen($trim) > $this->urlLen) {
            SingletonLogger::getInstance()->msgToLogger('ERROR: length of domain naim more then 20 symbol');
            throw new \http\Exception\InvalidArgumentException('length of domain naim more then 20 symbol');
        }
        $concat = $trim . '/' . str_shuffle($trim . static::CHAR_SET);

        return substr($concat, 0, $this->urlLen);
    }
}