<?php


namespace AvrysPhp\Actions;

interface IUrlEncoder
{

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string;
}