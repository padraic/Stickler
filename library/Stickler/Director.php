<?php

namespace Stickler;

class Director
{

    protected $directory;

    protected $detectors = array();

    protected $logs = array();

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
            $logs = $scanner->getLog();
            $scanner->resetLog();
            foreach ($logs as $log) {
                $log['file'] = $file;
                $this->logs[] = $log;
            }
        } 
        var_dump($this->getLog()); // simple output for sanity testing
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

    public function getLog()
    {
        return $this->logs;
    }

}