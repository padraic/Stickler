<?php

namespace Stickler\Detector;

use Stickler;
use Stickler\Token as Token;

class CurlVerifyPeerDisabled implements DetectorInterface
{

    protected $triggered = false;

    public function notify($token, $index, Stickler\FileTokens $tokens)
    {
        if (Token::getType($token) == T_STRING
        && Token::getString($token) == 'curl_setopt') {
            $closingBracket = $this->findClosingBracket($index, $tokens);
            $flagValueParam = Token::getString($tokens[$closingBracket-1]);
            if (strtolower($flagValueParam) == 'false') {
                $this->setTriggered(true);
                return true;
            }
        }
    }

    public function isTriggered()
    {
        return $this->triggered;
    }

    public function setTriggered($boolean)
    {
        $this->triggered = (bool) $boolean;
    }

    protected function findClosingBracket($index, Stickler\FileTokens $tokens)
    {
        $count = count($tokens);
        for ($i=$index; $i < $count; $i++) { 
            if (Token::getType($tokens[$i]) == Token::CHAR
            && Token::getString($tokens[$i]) == ')') {
                return $i;
            }
        }
        throw new \RuntimeException(
            'Unable to locate next closing brace. File may contain syntax errors.'
        );
    }

}