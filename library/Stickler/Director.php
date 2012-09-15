<?php

namespace Stickler;

class Director
{

    protected $directory;

    protected $detectors = array();

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function scan()
    {
        $loader = $this->getDirectoryLoader();
        $tokenizer = $this->getTokenizer();
        $scanner = $this->getScanner();
        $scanner->attach(new Detector\CurlVerifyPeerDisabled);
        $files = $loader->load($this->directory);
        foreach ($files as $file) {
            $tokens = $tokenizer->tokenize($file);
            $tokens->setFilePath($file);
            $tokens->setFileName(basename($file));
            $scanner->scan($tokens);
        }
        var_dump($scanner->getLog()); // simple output for sanity testing
    }

    public function getDirectoryLoader()
    {
        $return = new DirectoryLoader;
        return $return;
    }

    public function getTokenizer()
    {
        $return = new Tokenizer;
        return $return;
    }

    public function getScanner()
    {
        $return = new Scanner;
        return $return;
    }

}