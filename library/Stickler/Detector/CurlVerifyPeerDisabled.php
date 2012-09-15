<?php

namespace Stickler/Detector;

class CurlVerifyPeerDisabled
{

    protected $triggered = false;

    public function notify($something)
    {
        // check if something is within scope of detector or return
        // do something to detect a problem
        // if problem detected - log it and set triggered=TRUE
        // if nothing detected - do nothing
    }

    public function isTriggered()
    {
        return $this->triggered;
    }

    public function setTriggered($boolean)
    {
        $this->triggered = (bool) $boolean;
    }

}