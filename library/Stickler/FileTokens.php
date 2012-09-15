<?php

namespace Stickler;

class FileTokens extends \ArrayObject
{

    protected $fileName;

    protected $filePath;

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

}