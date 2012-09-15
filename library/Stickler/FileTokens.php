<?php

namespace Stickler;

class FileTokens
{

    protected $fileName;

    protected $filePath;

    protected $tokens = array();

    public function __construct($fileName, $filePath, array $tokens)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
        $this->tokens = $tokens;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getTokens()
    {
        return $this->tokens;
    }

}