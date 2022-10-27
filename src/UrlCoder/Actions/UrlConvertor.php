<?php

namespace AvrysPhp\UrlCoder\Actions;

use AvrysPhp\UrlCoder\Exceptions\DataNotFoundException;
use AvrysPhp\UrlCoder\Helpers\SingletonLogger;
use AvrysPhp\UrlCoder\Interfaces\ICodeRepository;
use AvrysPhp\UrlCoder\Interfaces\IUrlDecoder;
use AvrysPhp\UrlCoder\Interfaces\IUrlEncoder;
use AvrysPhp\UrlCoder\Interfaces\IUrlValidator;
use InvalidArgumentException;


class UrlConvertor implements IUrlDecoder, IUrlEncoder
{
    protected IUrlValidator $validator;
    protected ICodeRepository $repository;
    const CHAR_SET = '0123456789abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ';
    protected array $arrCutParts;
    protected int $urlLen;

    /**
     * @param ICodeRepository $repository
     * @param IUrlValidator $validator
     * @param int $urlLen
     */
    public function __construct(ICodeRepository $repository, IUrlValidator $validator, int $urlLen )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->arrCutParts = array('https://', 'www.');
        $this->urlLen = $urlLen;
    }

    /**
     * @param string $code
     * @throws \InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string
    {
        try {
            $result = $this->repository->getUrlByCode($code);
        } catch (DataNotFoundException $e) {
            SingletonLogger::error($e->getMessage());
            throw new InvalidArgumentException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
        return $result;
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