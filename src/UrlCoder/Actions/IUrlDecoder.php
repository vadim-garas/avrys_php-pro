<?php

namespace AvrysPhp\Actions;

interface IUrlDecoder
{
    /**
     * @param string $code
     * @throws \InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string;
}