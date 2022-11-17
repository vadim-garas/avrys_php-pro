<?php

namespace AvrysPhp\UrlCoder\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';
}