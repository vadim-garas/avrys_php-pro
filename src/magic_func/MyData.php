<?php

namespace AvrysPHP\magic_fun;

use http\Exception;

class MyData
{
    protected $arrData;
    private $fileData;

    public function __construct($arrData)
    {
        $this->arrData = $arrData;
    }

    public function getFromFile($todoName): void
    {
        if (file_exists($todoName)){
            $file = file_get_contents($todoName);  // Открыть файл data.json
            $this->fileData = json_decode($file,TRUE);        // Декодировать в массив
            unset($file);
        } else {
            throw new \http\Exception\InvalidArgumentException('operator not exist');
        }
    }

    public function addToFile($todoName, $arrData): void
    {
        if ($todoName){
            $fileData = file_put_contents($todoName, json_encode($this->__serialize(), JSON_FORCE_OBJECT));
            unset($this->fileData);
            $this->arrData = $this->__unserialize($fileData);
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
        }
    }

    /**
     * @return mixed
     */
    public function __get(string $name)
    {
        // TODO: Implement __get() method.
        return $this->$name;
    }

    public function __set(string $name, $value): void
    {
        // TODO: Implement __set() method.
        $this->$name = $value;
    }
}