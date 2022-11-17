<?php

namespace AvrysPhp\UrlCoder\Actions;

use AvrysPhp\UrlCoder\Helpers\SingletonLogger;
use AvrysPhp\UrlCoder\Interfaces\IUrlValidator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;


class UrlValidator implements IUrlValidator
{
    protected ClientInterface $client;
    protected array $allowCodes = array(200, 201, 301, 302);

    /**
     * @return void
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return bool
     */
    public function urlFormatValidate(string $url): bool
    {
        try {
            $urlValid = filter_var($url, FILTER_VALIDATE_URL);
        } catch (\Exception $e) {
            SingletonLogger::getInstance()->msgToLogger('ERROR: failed data, url is not valid');
            throw new InvalidArgumentException('url is not valid');
        }

        return true;
    }

    /**
     * @param string $url
     * @return bool
     * @throws InvalidArgumentException|GuzzleException
     */
    public function urlExistsVerify(string $url): bool
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