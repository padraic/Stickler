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
        $files = $loader->load($this->directory);
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $tokens = $tokenizer->tokenize($content);
            $scanner->scan($tokens);
        }
        foreach ($this->detectors as $detector) {
            if ($detector->isTriggered()) {
                echo get_class($detector), ' was triggered', "\n";
            }
        }
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

    public function attach(Detector/DetectorInterface $detector)
    {
        $this->detectors[get_class($detector)] = $detector;
    }

    public function detach(Detector/DetectorInterface $detecter)
    {
        $this->detectors[get_class($detector)] = null;
    }

    public function notify($something)
    {
        foreach ($this->detectors as $detector) {
            $detector->notify($something);
        }
    }

}