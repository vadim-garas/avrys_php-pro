<?php

namespace AvrysPhp\UrlCoder\Actions;

use AvrysPhp\UrlCoder\Helpers\SingletonLogger;
use http\Exception\InvalidArgumentException;


class UrlConnect
{
    protected \GuzzleHttp\Client $client;
    protected $allowCodes = array(200, 201, 301, 302);

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
        try {
            $urlValid = filter_var($url, FILTER_VALIDATE_URL);
        } catch (\Exception $e) {
            SingletonLogger::getInstance()->msgToLogger('ERROR: failed data, url is not valid');
            throw new InvalidArgumentException('url is not valid');
        }

        $this->urlExistsVerify($urlValid);
    }

    /**
     * @param string $url
     * @return bool
     *@throws \Exception
     */
    private function urlExistsVerify(string $url): bool
    {
        $result = false;

        try {
            $response = $this->client->request('GET', $url);
            $code = $response->getStatusCode();

            $result = in_array($code, $this->allowCodes);
        } catch (\Exception $e) {
            SingletonLogger::getInstance()->msgToLogger('ERROR: url is not exists');
            throw new InvalidArgumentException('url: ' . $url . ' is not exist');
        } finally {
            return $result;
        }
    }
}