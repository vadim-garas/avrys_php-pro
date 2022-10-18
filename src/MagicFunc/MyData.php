<?php

namespace AvrysPhp\MagicFunc;

use http\Exception;

class MyData
{
    protected array $arrData;
    private mixed $fileData;

    public function __construct($arrData)
    {
        $this->arrData = $arrData;
    }

    public function getFromFile($todoName): void
    {
        if (file_exists($todoName)){
            $file = file_get_contents($todoName);
            $this->fileData = json_decode($file,TRUE);
            unset($file);
        } else {
            throw new \http\Exception\InvalidArgumentException('operator not exist');
        }
    }

    public function addToFile($todoName, $arrData): void
    {
        if ($todoName){
            $this->fileData = file_put_contents($todoName, json_encode($this->__serialize(), JSON_FORCE_OBJECT));
            $this->__unserialize($arrData);
            unset($this->fileData);
        } else {
            throw new \http\Exception\InvalidArgumentException('is not exist');
        }
    }

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
        return get_object_vars( $this );
    }

    public function __unserialize(array $data): void
    {
        // TODO: Implement __unserialize() method.
        foreach ( $data as $key => $value ) {
            $this->$key = $value;
            echo 'Data field key: '.$key.', value: '.$value;
        }
    }

    public function __clone(): void
    {
        $this->arrData = array('green', 'blue');
    }

    /**
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }
}