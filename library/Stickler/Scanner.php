<?php

namespace Stickler;

class Scanner
{

    protected $detectors = array();

    protected $log = array();

    public function scan(FileTokens $tokens)
    {
        foreach($tokens as $index=>$token) {
            $this->notify($token, $index, $tokens); // notify all (limit by config later)
        }
    }

    public function attach(Detector\DetectorInterface $detector)
    {
        $this->detectors[get_class($detector)] = $detector;
    }

    public function detach(Detector\DetectorInterface $detecter)
    {
        unset($this->detectors[get_class($detector)]);
    }

    public function notify($token, $index, FileTokens $tokens)
    {
        foreach ($this->detectors as $detector) {
            $result = $detector->notify($token, $index, $tokens);
            if ($result === true) {
                $this->log[] = array(
                    'detector' => get_class($detector),
                    'line' => Token::getLine($token)
                );
            }
        }
    }

    public function getTriggered()
    {
        $return = array();
        foreach ($this->detectors as $detector) {
            if ($detector->isTriggered()) {
                $return[] = $detector;
            }
        }
        return $return;
    }

    public function getLog()
    {
        return $this->log;
    }

}