<?php

namespace AvrysPhp\Actions;

class UrlConnect
{
    protected object $curl;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->curl = curl_init();
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

        echo 'RESPONSE: ' . $response . PHP_EOL;
        if (empty($response) || $response != 200) {
            throw new \http\Exception\InvalidArgumentException('url is not exist');
        }
    }
}