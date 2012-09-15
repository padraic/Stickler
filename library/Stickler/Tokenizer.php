<?php

namespace Stickler;

class Tokenizer
{

    public function tokenize($filePath)
    {
        $content = file_get_contents($filePath);
        $tokens = token_get_all($content);
        return $this->getFileTokens(
            $this->clean($tokens)
        );
    }

    protected function clean(array $tokens)
    {
        $count = count($tokens);
        for ($i=0; $i < $count; $i++) { 
            if (in_array(Token::getType($tokens[$i]), array(
                T_BAD_CHARACTER,
                T_COMMENT,
                T_WHITESPACE,
                T_DOC_COMMENT,
                T_OPEN_TAG,
                T_INLINE_HTML
            ))) {
                unset($tokens[$i]); // delete whitespace and nonessential bits
            } elseif(Token::getType($tokens[$i]) == T_OPEN_TAG_WITH_ECHO) {
                $tokens[$i][1] = 'echo'; // replace <?= shortcut
            } elseif (Token::getType($tokens[$i]) == T_CLOSE_TAG) {
                $tokens[$i] = ';'; // semi is optional for last statement
            } elseif (Token::getType($tokens[$i]) == Token::CHAR
            && Token::getString($tokens[$i]) == '@') {
                unset($tokens[$i]); //error suppression irrelevant
            }
        }
        $tokens = array_values($tokens);
        return $tokens;
    }

    protected function getFileTokens(array $tokens)
    {
        $return = new FileTokens($tokens);
        return $return;
    }

}