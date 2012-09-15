<?php

namespace Stickler;

class Tokenizer
{

    public function tokenize($string)
    {
        $tokens = token_get_all($string);
        return $this->clean($tokens);
    }

    protected function clean(array $tokens)
    {
        // clean the tokens
        // - remove whitespace
        // - check braces
        // - check prepends
        
        return $tokens;
    }

}