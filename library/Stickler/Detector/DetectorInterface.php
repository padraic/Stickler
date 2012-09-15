<?php

namespace Stickler/Detector;

interface DetectorInterface
{

    public function notify($something);

    public function isTriggered();

}