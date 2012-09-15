<?php

namespace Stickler;

class DirectoryLoader
{

    public function load($path)
    {
        $files = array();
        $directory = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator(
            $iterator,
            "/^.+\.php$/i",
            \RecursiveRegexIterator::GET_MATCH
        );
        foreach($regex as $array) $files[] = $array[0];
        return $files;
    }

}