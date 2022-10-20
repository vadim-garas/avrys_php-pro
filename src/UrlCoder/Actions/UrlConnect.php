<?php

namespace AvrysPhp\UrlCoder\Actions;

use CurlHandle;
use Psr\Log\LoggerInterface;


class UrlConnect
{
    protected CurlHandle $curl;
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     * @return void
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->curl = curl_init();
        $this->logger = $logger;
        $this->logger->alert("class CurlHandle is construct.");
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return void
     */
    public function urlFormatValidate(string $url): void
    {
        $urlValid = filter_var($url, FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED);
        if (!$urlValid) {
            $this->logger->error("ERROR: url is not valid");
            throw new \http\Exception\InvalidArgumentException('url is not valid');
        }

        $this->urlExistsVerify($urlValid);
    }

    /**
     * @param string $url
     * @return void
     *@throws \InvalidArgumentException
     */
    private function urlExistsVerify(string $url): void
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_NOBODY, true);
        curl_setopt($this->curl,  CURLOPT_RETURNTRANSFER, true);
        curl_exec($this->curl);
        $response = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if (empty($response) || $response != 200) {
            $this->logger->error("ERROR: url is not exists");
            throw new \http\Exception\InvalidArgumentException('url is not exist');
        }
    }
}