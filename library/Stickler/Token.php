<?php

namespace Stickler;

class Token
{

    const CHAR = 'chartoken';

    public static function getType($token)
    {
        if(is_array($token)) {
            return $token[0];
        }
        return self::CHAR;
    }

    public static function getString($token)
    {
        if(is_array($token)) {
            return $token[1];
        }
        return $token;
    }

    public static function getLine($token)
    {
        if(is_array($token)) {
            return $token[2];
        }
        return false; // irrelevant to chars anyway most likely
    }

    public static function setString(&$token, $string)
    {
        if (is_array($token)) {
            $token[1] = $string;
        } else {
            $token = $string;
        }
    }

}