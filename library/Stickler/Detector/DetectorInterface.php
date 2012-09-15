<?php

namespace Stickler\Detector;
use Stickler;

interface DetectorInterface
{

    public function notify($token, $index, Stickler\FileTokens $tokens);

    public function isTriggered();

}