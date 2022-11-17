<?php

namespace Avrys\PhpPro\Core\CLI\Helpers;

use Avrys\PhpPro\Core\CLI\Interfaces\ICliPathCreator;


class CliPathCreator implements ICliPathCreator
{
    protected string $dirPath;

    public function dirPathCreate($dirPath): bool
    {
        $this->dirPath = $dirPath;
        $dir_path = $this->cutLastPathPart($this->dirPath);
        return $this->createDirectory($dir_path, $mode = 0777);
    }

    /**
     * @param $path
     * @param $mode
     * @return bool
     */
    protected function createDirectory($path, $mode): bool
    {
        if (!is_dir($path)) {
            do {
                $prev_path = $this->getPrewPath($path, $mode);
                $this->createDirectory($prev_path, $mode);
            } while ($path != $prev_path);
        }
        return true;
    }

    /**
     * @param $path
     * @param $mode
     * @return string
     */
    protected function getPrewPath($path, $mode): string
    {
        $prev_path = $this->cutLastPathPart($path);

        if (is_dir($prev_path) && is_writable($prev_path)) {
            mkdir($path, $mode, true);
            return $path;
        }
        return $prev_path;
    }

    /**
     * @param $path
     * @return string
     */
    protected function cutLastPathPart($path): string
    {
        return substr($path, 0, strrpos($path, '/', -2) + 1);
    }
}