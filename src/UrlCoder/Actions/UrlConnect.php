<?php

namespace AvrysPhp\UrlCoder\Actions;

use AvrysPhp\UrlCoder\Helpers\MyLogger;


class UrlConnect
{
    protected \GuzzleHttp\Client $client;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param string $url
     * @return void
     *@throws \Exception
     */
    public function urlFormatValidate(string $url): void
    {
        $urlValid = filter_var($url, FILTER_VALIDATE_URL);
        if (!$urlValid) {
            MyLogger::getInstance()->msgToLogger('ERROR: failed data, url is not valid');
            throw new \http\Exception\InvalidArgumentException('url is not valid');
        }
        $this->urlExistsVerify($urlValid);
    }

    /**
     * @param string $url
     * @return void
     *@throws \Exception
     */
    private function urlExistsVerify(string $url): void
    {
        $response = $this->client->request('GET', $url);
        $code = $response->getStatusCode();
        if ( $code != 200 ) {
            MyLogger::getInstance()->msgToLogger('ERROR: url is not exists');
            throw new \http\Exception\InvalidArgumentException('url: ' . $url . ' is not exist');
        }
    }
}